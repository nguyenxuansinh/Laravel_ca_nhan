<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fs-1 fw-semibold" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto" style="align-items: center;">

                <li class="nav-item ">
                    <form id="search-form" method="get" action="{{ route('tasks.search') }}" class="d-flex">
                        @csrf
                        <select class="selectpicker form-select" data-live-search="true" name="selectedValue"
                            title="Select an option">
                            <option value="">ALL</option>
                            <option value="đa hoan thanh">Đã Hoàn thành</option>
                            <option value="chua hoan thanh">Chưa hoàn thành</option>
                        </select>
                        <input name="search" type="search" class="form-control me-2" placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-success" type="submid">search</button>
                    </form>
                </li>

                
            </ul>
        </div>
    </div>
</nav>
