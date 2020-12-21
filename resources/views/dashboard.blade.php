<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div id="containMain" class="container contain-orderFood">
        <div class="row">
            <div class="col-lg-10 col-sm-12 col-table p-4">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($tables as $table)
                    <div class="col">
                        <a id="detailOrder" href="#" data-bs-toggle="modal"
                            data-bs-target="#detailOrder{{ $table->id }}" data-id="{{ $table->id }}">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Table. {{ $table->no_table }}</h5>
                                    @foreach ($orders as $order)
                                    @if($order->table_id === $table->id && $order->status === 1)
                                    <p id="noPesanan" class="card-text">No. Pesananan: {{ $order->no_transaksi }}</p>
                                    <p id="statusOrder" class="text-right text-green">
                                        <strong>Active</strong></p>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Modal Detail Order-->
                    <div class="modal fade" id="detailOrder{{ $table->id }}" tabindex="-1"
                        aria-labelledby="detailOrder{{ $table->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailOrder{{ $table->id }}Label">Detail Order</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="card-title">Table. {{ $table->no_table }}
                                    </h5>
                                    @foreach ($orders as $order)
                                    @if($order->table_id === $table->id && $order->status === 1)
                                    <p id="noPesanan" class="card-text">No. Pesananan: {{ $order->no_transaksi }}</p>
                                    <p>Menu:</p>
                                    <ul>
                                        @foreach ($order_menus as $order_menu)
                                        @if ($order->no_transaksi === $order_menu->no_transaksi)<li>
                                            {{ $order_menu->menu->name }}:
                                            {{ number_format($order_menu->price, 0 , ',', '.') }}</li>
                                        @endif
                                        @endforeach
                                    </ul>
                                    <h6 id="statusOrder" class="text-right">
                                        Total Price: Rp.
                                        <strong>{{ number_format($order->total_price, 0 , ',', '.') }}</strong>
                                    </h6>
                                    <p id="statusOrder" class="text-right text-green">
                                        <strong>Active</strong>
                                    </p>
                                    @if (Auth::user()->current_team_id === 2)
                                    <form action="{{ url('api/order/konfirm') }}/{{ $order->id }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        <button type="button" class="btn btn-primary btn-konfirm">Konfirm
                                            Payment</button>
                                    </form>
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#updateStock">
                            Update Stock Menu
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
            <form id="formAddTable" action="#" class="pl-3 pr-3">
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
                    <button type="submit" id="submitTable" class="btn btn-primary">Save Change</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Add Menu-->
<div class="modal fade" id="addMenu" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formAddMenu" class="pl-3 pr-3">
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

<!-- Modal Add Menu Type-->
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

<!-- Modal Update Stock Menu -->
<div class="modal fade" id="updateStock" tabindex="-1" aria-labelledby="updateStockLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="stockPost" action="{{ url('/api/menu/stock') }}" method="post" class="pl-3 pr-3">
                @method('patch')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStockLabel">Update Stock Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @foreach ($menuTypes as $type)
                    <h5><strong>{{ $type->name }}</strong></h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Menu</th>
                                <th scope="col">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                            @if ($menu->menu_type_id === $type->id)
                            <tr>
                                <td>{{ $menu->name }}</td>
                                <td>
                                    <input type="hidden" name="menuId[]" value="{{ $menu->id }}">
                                    <input class="form-control" type="text" name="stock[]" required
                                        value="{{ $menu->stock }}">
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    @endforeach

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
            <form id="formAddOrder" class="pl-3 pr-3">
                @csrf
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
            <form id="formAddOrder" class="pl-3 pr-3">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTableLabel">Add Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bodyModalOrder">
                    <div class="form-group mb-2">
                        <label class="mr-sm-2" for="no_table">No. Meja</label>
                        <select class="form-select mr-sm-2" id="no_table" name="no_table">
                            @foreach ($tables as $table)
                            @if ($table->status !== 1)
                            <option value="{{ $table->id }}">{{ $table->no_table }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <button type="button" class="btn btn-primary" id="addItemMakan">Add Makanan</button>
                        <button type="button" class="btn btn-primary" id="addItemMinum">Add Minuman</button>
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