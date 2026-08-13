<?php

use App\Models\{
    AcademicYear,
    Classroom,
    Grade,
    Invoice,
    Major,
    Post,
    Registration,
    Student,
    Subject,
    Teacher,
    TestQuestion,
    User,
};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

uses(Tests\TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    foreach (['admin', 'tu', 'walikelas', 'walimurid'] as $roleName) {
        Role::firstOrCreate(['name' => $roleName]);
    }
});

describe('public pages', function () {
    it('homepage renders with published posts', function () {
        Post::factory()->count(3)->create([
            'status' => 'published',
            'published_at' => now(),
            'is_highlight' => true,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertViewHas('recentNews');
    });

    it('news listing page shows published articles', function () {
        Post::factory()->count(2)->create([
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->get(route('berita.index'))
            ->assertOk()
            ->assertViewHas('posts');
    });

    it('news detail page increments views', function () {
        $post = Post::factory()->create([
            'status' => 'published',
            'published_at' => now(),
            'views' => 5,
        ]);

        $this->get(route('berita.show', $post))
            ->assertOk();

        expect($post->fresh()->views)->toBe(6);
    });

    it('school profile page is created if not exists', function () {
        $this->get(route('profil'))
            ->assertOk();

        expect(\App\Models\Page::where('slug', 'profil-sekolah')->exists())->toBeTrue();
    });

    it('major and teacher public pages render correctly', function () {
        Major::factory()->count(2)->create();
        Teacher::factory()->count(2)->create();

        $this->get(route('jurusan'))->assertOk();
        $this->get(route('gtk'))->assertOk();
    });

    it('search returns matching published posts', function () {
        Post::factory()->create([
            'title' => 'Prestasi Siswa Baru',
            'status' => 'published',
            'published_at' => now(),
            'content' => '<p>Konten kompetisi sekolah</p>',
        ]);

        $response = $this->get('/search?q=Prestasi');

        $response->assertOk()->assertViewHas('posts');
        expect($response->viewData('query'))->toBe('Prestasi');
    });
});

describe('ppdb flow', function () {
    it('storePendaftaran creates registration and redirects to payment step', function () {
        $major = Major::factory()->create();

        $this->post(route('ppdb.store'), [
            'name' => 'Andi Pratama',
            'origin_school' => 'SMP Negeri 1 Kota',
            'phone' => '081234567890',
            'parent_name' => 'Ibu Sari',
            'parent_email' => 'orangtua@example.com',
            'parent_password' => 'secret123',
            'major_id' => $major->id,
        ])->assertRedirect();

        $this->assertDatabaseHas('registrations', [
            'name' => 'Andi Pratama',
            'parent_email' => 'orangtua@example.com',
            'status' => 'Pending',
            'payment_status' => 'Unpaid',
        ]);
    });

    it('processPembayaran moves the registration to paid status', function () {
        $registration = Registration::factory()->create([
            'payment_status' => 'Unpaid',
            'status' => 'Pending',
        ]);

        $this->post(route('ppdb.process_pembayaran', $registration->id), [
            'payment_method' => 'Bank Transfer',
        ])->assertRedirect(route('ppdb.test', $registration->id));

        expect($registration->fresh()->payment_status)->toBe('Paid');
        expect($registration->fresh()->payment_method)->toBe('Bank Transfer');
    });

    it('submitTest calculates the score and stores it', function () {
        $registration = Registration::factory()->create(['test_score' => null]);

        $questionA = TestQuestion::create([
            'question' => 'Bentuk negara Indonesia adalah?',
            'option_a' => 'Kesatuan',
            'option_b' => 'Kerajaan',
            'option_c' => 'Republik',
            'option_d' => 'Federasi',
            'correct_answer' => 'A',
        ]);

        $questionB = TestQuestion::create([
            'question' => '2 + 2 = ?',
            'option_a' => '3',
            'option_b' => '5',
            'option_c' => '4',
            'option_d' => '6',
            'correct_answer' => 'C',
        ]);

        $this->post(route('ppdb.test.submit', $registration->id), [
            'answers' => [
                $questionA->id => 'A',
                $questionB->id => 'B',
            ],
        ])->assertRedirect(route('ppdb.berhasil'));

        expect($registration->fresh()->test_score)->toBe(50);
    });

    it('accept converts a ppdb registration into a parent account and student', function () {
        $major = Major::factory()->create();
        $classroom = Classroom::factory()->create(['major_id' => $major->id, 'name' => 'X-1']);
        $registration = Registration::factory()->create([
            'name' => 'Dina Putri',
            'parent_name' => 'Bapak Budi',
            'parent_email' => 'bapakbudi@example.com',
            'parent_password' => Hash::make('secret123'),
            'major_id' => $major->id,
            'status' => 'Pending',
        ]);

        $tuUser = User::factory()->create();
        $tuUser->assignRole('tu');

        $this->actingAs($tuUser)
            ->post(route('tu.ppdb.accept', $registration->id))
            ->assertSessionHas('success');

        $parent = User::where('email', 'bapakbudi@example.com')->first();

        expect($parent)->not->toBeNull()
            ->and($parent->hasRole('walimurid'))->toBeTrue()
            ->and(Student::where('name', 'Dina Putri')->where('parent_id', $parent->id)->exists())->toBeTrue();
    });

    it('reject marks a registration as rejected', function () {
        $registration = Registration::factory()->create(['status' => 'Pending']);
        $tuUser = User::factory()->create();
        $tuUser->assignRole('tu');

        $this->actingAs($tuUser)
            ->post(route('tu.ppdb.reject', $registration->id))
            ->assertSessionHas('success');

        expect($registration->fresh()->status)->toBe('Ditolak');
    });

    it('destroy deletes a ppdb record', function () {
        $registration = Registration::factory()->create();
        $tuUser = User::factory()->create();
        $tuUser->assignRole('tu');

        $this->actingAs($tuUser)
            ->delete(route('tu.ppdb.destroy', $registration->id))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('registrations', ['id' => $registration->id]);
    });
});

describe('wali and guru features', function () {
    it('wali sees and can pay their child invoices', function () {
        $parent = User::factory()->create();
        $parent->assignRole('walimurid');

        $student = Student::factory()->create(['parent_id' => $parent->id]);
        $invoice = Invoice::factory()->create([
            'student_id' => $student->id,
            'is_paid' => false,
        ]);

        $this->actingAs($parent)
            ->get(route('wali.tagihan.index'))
            ->assertOk()
            ->assertViewHas('invoices');

        $this->actingAs($parent)
            ->post(route('wali.tagihan.pay', $invoice))
            ->assertRedirect(route('wali.tagihan.index'));

        expect($invoice->fresh()->is_paid)->toBeTrue();
    });

    it('guru can input student grades for their classroom', function () {
        $teacherUser = User::factory()->create(['name' => 'Guru Matematika']);
        $teacherUser->assignRole('walikelas');

        $teacher = Teacher::factory()->create(['name' => $teacherUser->name]);
        $classroom = Classroom::factory()->create(['teacher_id' => $teacher->id]);
        $subject = Subject::factory()->create();
        $academicYear = AcademicYear::factory()->create();
        $student = Student::factory()->create(['classroom_id' => $classroom->id]);

        $this->actingAs($teacherUser)
            ->post(route('guru.nilai.store'), [
                'academic_year_id' => $academicYear->id,
                'subject_id' => $subject->id,
                'classroom_id' => $classroom->id,
                'grades' => [
                    $student->id => [
                        'score' => 92,
                        'notes' => 'Sangat baik',
                    ],
                ],
            ])
            ->assertRedirect(route('guru.nilai.index'));

        $this->assertDatabaseHas('grades', [
            'student_id' => $student->id,
            'subject_id' => $subject->id,
            'academic_year_id' => $academicYear->id,
            'score' => 92,
        ]);
    });
});
