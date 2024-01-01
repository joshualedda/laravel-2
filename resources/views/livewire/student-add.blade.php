<div>
    <section class="p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="d-flex align-items-start justify-content-start mb-2 p-2">
                        {{-- button in adding --}}
                        <a class="btn btn-sm btn-success" href="{{ url('studentInfo') }}">
                            Add Student
                        </a>
                        {{-- button in adding --}}
                    </div>
                    <div class="card-body shadow-lg m-0">
                        {{-- Powergrid --}}
                        <livewire:student-table />
                        {{-- Powergrid --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
