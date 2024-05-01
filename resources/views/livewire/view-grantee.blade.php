<div>
    <section class="p-2">
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12">
                {{-- no need to this --}}
                {{-- <div class="d-flex align-items-center mb-2">
                    <a class="btn btn-warning btn-sm fw-bold" href="{{ url('viewGrantee') }}">Reset</a>
                </div> --}}

<div class="card">
    <div class="card-header">Grantees Data</div>
    <div class="card-body">
        @if(request()->routeIs('view-grantee'))
                <livewire:student-grantee />
                @endif

                @if(request()->routeIs('viewGrantee.government'))
                <livewire:student-grantee-filter />
                @endif

                @if(request()->routeIs('viewGrantee.private'))
                <livewire:student-grantee-private/>
                @endif

            </div>
        </div>


            </div>
        </div>
    </section>
</div>
