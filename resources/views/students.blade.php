<!-- Students Blade Template -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Students</h1>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createStudentModal">Create New Student</a>
        </div>
    </div>
    <div class="row">
        @foreach($students as $student)
            <div class="col-md-4">
                <div class="card student-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $student->name }}</h5>
                        <p class="card-text">{{ $student->email }}</p>
                        <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $student->id }}">Edit</a>
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteStudentModal{{ $student->id }}">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Create Student Modal -->
<div class="modal fade" id="createStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
@foreach($students as $student)
    <div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student {{ $student->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Delete Student Modal -->
@foreach($students as $student)
    <div class="modal fade" id="deleteStudentModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Student {{ $student->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete student {{ $student->name }}?</p>
                    <form action="#" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<link rel="stylesheet" href="{{ asset('css/students.css') }}">
<script src="{{ asset('js/students.js') }}"></script>
