<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container contain-orderFood">
        <div class="row">
            <div class="col-lg-10 col-sm-12 col-table p-4">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($tables as $table)
                    <div class="col">
                        <a id="detailOrder" href="#" data-bs-toggle="modal" data-bs-target="#detailOrder"
                            data-id="{{ $table->id }}">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Table. {{ $table->no_table }}</h5>
                                    <p id="noPesanan" class="card-text">No. Pesananan: ABC10102019-001</p>
                                    <p id="statusOrder" class="text-right text-green"><strong>Active</strong></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-2 col-sm-12 col-add p-4 justify-content-center">
                <ul>
                    <li>
                        <!-- Button Add Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTable">
                            Add Table
                        </button>
                    </li>
                    <li>
                        <!-- Button Add Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMenu">
                            Add Menu
                        </button>
                    </li>
                    <li>
                        <!-- Button Add Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrder">
                            Add Order
                        </button>
                    </li>
                    <li>
                        <!-- Button Add Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#detailMenu">
                            Detail Menu
                        </button>
                    </li>
                </ul>


            </div>
        </div>
    </div>

</x-app-layout>

<!-- Modal Add Table-->
<div class="modal fade" id="addTable" tabindex="-1" aria-labelledby="addTableLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/table') }}" method="post" class="pl-3 pr-3">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTableLabel">Add Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="no_table">No. Table</label>
                        <input class="form-control" type="text" id="no_table" name="no_table" required
                            value="{{ old('no_table') }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Add Menu-->
<div class="modal fade" id="addMenu" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/menu') }}" method="post" class="pl-3 pr-3">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTableLabel">Add Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group mb-2">
                        <label for="name">Menu Name</label>
                        <input class="form-control" type="text" id="name" name="name" required
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label class="mr-sm-2" for="menu_type_id">Menu Type</label>
                        <select class="form-select mr-sm-2" id="menu_type_id" name="menu_type_id">
                            <option selected disabled>Choose...</option>
                            @foreach ($menuTypes as $menuType)
                            <option value="{{ $menuType->id }}">{{ $menuType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="stock">Stock</label>
                        <input class="form-control" type="text" id="stock" name="stock" required
                            value="{{ old('stock') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="price">Price</label>
                        <input class="form-control" type="text" id="price" name="price" required
                            value="{{ old('price') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Add Table-->
<div class="modal fade" id="addTable" tabindex="-1" aria-labelledby="addTableLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/menu_type') }}" method="post" class="pl-3 pr-3">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTableLabel">Add Menu Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="type">Menu Type</label>
                        <input class="form-control" type="text" id="type" name="type" required
                            value="{{ old('type') }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Menu-->
<div class="modal fade" id="detailMenu" tabindex="-1" aria-labelledby="detailMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailMenuLabel">Detail Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Tipe</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->menu_type_id }}</td>
                            <td>{{ $menu->stock }}</td>
                            <td>{{ $menu->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Order-->
<div class="modal fade" id="addOrder" tabindex="-1" aria-labelledby="addOrderLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/menu') }}" method="post" class="pl-3 pr-3">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTableLabel">Add Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group mb-2">
                        <label for="name">Menu Name</label>
                        <input class="form-control" type="text" id="name" name="name" required
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label class="mr-sm-2" for="menu_type_id">Menu Type</label>
                        <select class="form-select mr-sm-2" id="menu_type_id" name="menu_type_id">
                            <option selected disabled>Choose...</option>
                            @foreach ($menuTypes as $menuType)
                            <option value="{{ $menuType->id }}">{{ $menuType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="stock">Stock</label>
                        <input class="form-control" type="text" id="stock" name="stock" required
                            value="{{ old('stock') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="price">Price</label>
                        <input class="form-control" type="text" id="price" name="price" required
                            value="{{ old('price') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Order-->
<div class="modal fade" id="detailOrder" tabindex="-1" aria-labelledby="detailOrderLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailOrderLabel">Detail Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>