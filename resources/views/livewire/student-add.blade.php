<div>
    <section class="p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="d-flex align-items-start justify-content-start mb-2 p-2">
                        <div class="gap-2">

                            {{-- button in adding --}}
                            <a class="btn btn-sm btn-success" href="{{ url('studentInfo') }}">
                                Add Student
                            </a>
                            {{-- button in adding --}}

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Import
                            </button>


                        </div>
                    </div>
                    <div class="card-body shadow-lg m-0">
                        {{-- Powergrid --}}
                        <livewire:student-table />
                        {{-- Powergrid --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: blue">
                        <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Import CSV</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group">
                            <div class="row p-1">
                                <div class="list-group-item list-group-item-action col-md-3">
                                    <span class="badge bg-primary rounded-pill">1</span>
                                    Add or Edit students info in CSV template
                                    <div>
                                        <span class="text-muted">
                                            Required fields are the student id, firstname, lastname, middle initial,
                                            email, sex, status,barangay, municipal, province, campus, course, level,
                                            father, mother,contact,student type,name of school last attended and last
                                            school year attended.
                                        </span>
                                        <img src="{{ asset('assets/images/Picture1.png') }}" class="img-fluid"
                                        style="height: 110px; width:100% mt-2">
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action col-md-3">
                                    <span class="badge bg-primary rounded-pill">2</span>
                                    Upload CSV file
                                    <div>
                                        <input type="file" class="form-control form-control-sm mb-1" wire:model.live='csv_file'
                                        id="csv_file">
                                        <label for="csv_file" class="btn btn-primary btn-sm btn-file-label">Attach file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click='attachFile' wire:confirm="Are you sure?">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- it ends here --}}
    </section>
</div>
