<div>
    <section class="p-2">
        <div class="row">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Campus & Courses/Program</h3>
                </div>
                <div class="row p-2 align-items-center justify-content-center">
                    <div class="col-md-6">
                        @if (session('success'))
                        <div class="alert alert-success text-center alert-dismissible fade show" id="success">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center justify-content-center">
                        {{-- Form 1 --}}
                        <div class="col-md-6">
                            <div class="container shadow-lg w-100 h-100">
                                <form wire:submit.prevent='campusAdd'>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="campus" class="form-label">Campus name (abbreviation)</label>
                                            <input type="text" id="campus" class="form-control form-control-sm"
                                                name="campus" required wire:model.live='campus' />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="campusDesc" class="form-label">Campus Description</label>
                                            <input type="text" id="campusDesc" class="form-control form-control-sm"
                                                name="campusDesc" wire:model.live='campusDesc' required />
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row align-items-start justify-content-start m-2">
                                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Form 2 --}}
                        <div class="col-md-6">
                            <div class="container shadow-lg w-100 h-100">
                                <form wire:submit.prevent='courseAdd'>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="campus_select" class="form-label">Campus</label>
                                            <select name="campus_select" id="campus_select"
                                                class="form-select form-select-md" required wire:model.live='campus_select'>
                                                <option selected >Choose campus from below</option>
                                                @foreach ($campuses as $campus)
                                                <option value="{{ $campus->id }}">{{ $campus->campus_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="course_program" class="form-label">Course/Program</label>
                                            <input type="text" id="course_program" name="course_program"
                                                class="form-control form-control-sm" wire:model.live='course_program' required>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row align-items-start justify-content-start m-2">
                                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
