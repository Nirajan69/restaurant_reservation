@extends('customer.dashboard')

@section('content')

<!-- Custom Styles -->
<style>
    /* Global Styles */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f5f5f5;
        color: #333;
    }

    .reservation-form-container {
        max-width: 600px;
        margin: 30px auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .reservation-form-container h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #38a169;
        margin-bottom: 30px;
        text-align: center;
    }

    .reservation-form-container p {
        font-size: 1.25rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 2rem; /* Increased gap between lines */
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 12px;
        font-size: 1rem;
        box-shadow: none;
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus {
        border-color: #38a169;
        box-shadow: 0 0 5px rgba(56, 161, 105, 0.3);
    }

    label {
        font-weight: bold;
        color: #555;
        font-size: 1.1rem;
    }

    .btn-primary {
        background-color: #38a169;
        border-color: #38a169;
        padding: 10px 16px;
        font-size: 1.1rem;
        font-weight: 600;
        width: 100%;
        text-transform: uppercase;
        cursor: pointer;
        border-radius: 8px;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #2f8b55;
        border-color: #2f8b55;
    }

    .btn-success, .btn-danger {
        padding: 6px 12px; /* Smaller padding for both add and remove buttons */
        font-size: 0.9rem; /* Smaller font size */
        font-weight: 500;
        border-radius: 8px;
    }

    .btn-success {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .btn-success:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-danger {
        background-color: #e53e3e;
        border-color: #e53e3e;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c53030;
        border-color: #c53030;
    }

    .form-group small {
        font-size: 0.875rem;
        color: #e53e3e;
    }

    /* Reservation Details and Selected Menu Styles */
    .reservation-details, .selected-menus {
        font-weight: bold;
        font-size: 1.2rem;
        color: #333;
    }

    .selected-menus ul {
        margin-top: 1rem;
        padding-left: 20px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .reservation-form-container {
            padding: 20px;
        }

        .reservation-form-container h1 {
            font-size: 2rem;
        }

        .form-control {
            font-size: 0.9rem;
        }

        .btn-primary {
            font-size: 1rem;
        }
    }
</style>

<div class="reservation-form-container">
    <h1>Choose a Table and Menu</h1>

    <p class="text-center">Reservation for <span class="reservation-details">{{ $reservation->guests }} guests</span>.</p>

    <!-- Display the reservation details from Step 1 -->
    <div class="mb-4">
        <h4 class="reservation-details">Reservation Details:</h4>
        <ul>
            <li><strong>Name:</strong> {{ $reservation->name }}</li>
            <li><strong>Email:</strong> {{ $reservation->email }}</li>
            <li><strong>Date:</strong> {{ $reservation->date }}</li>
            <li><strong>Time:</strong> {{ $reservation->time }}</li>
            <li><strong>Guests:</strong> {{ $reservation->guests }}</li>
        </ul>
    </div>

    @if ($tables->isEmpty())
        <p>No tables available for the number of guests.</p>
    @else
        <form action="{{ route('customer.reservation.storeStepTwo', $reservation->id) }}" method="POST">
            @csrf

            <!-- Table Selection -->
            <div class="form-group">
                <label for="table">Select Table</label>
                <select name="table_id" id="table" class="form-control" required>
                    <option value="">Select a table</option>
                    @foreach ($tables as $table)
                        <option value="{{ $table->id }}"
                            @if ($table->id == old('table_id', $reservation->table_id)) selected @endif>
                            {{ $table->table_name }} (Seats: {{ $table->members }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Menu Selection with box -->
            <div class="form-group mt-4">
                <label for="menus">Select Menu(s)</label>
                <div class="form-control" style="border: 2px solid #ced4da; padding: 20px; background-color: #f9f9f9;">
                    <ul class="list-group">
                        @foreach ($menus as $menu)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $menu->name }} (Price: ${{ $menu->price }})
                                <button type="button" class="btn btn-sm btn-success add-menu"
                                    data-id="{{ $menu->id }}" data-name="{{ $menu->name }}"
                                    data-price="{{ $menu->price }}">Add</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Selected Menus -->
            <div class="form-group mt-4">
                <h5 class="selected-menus">Selected Menus:</h5>
                <ul id="selected-menus" class="list-group"></ul>
                <input type="hidden" name="selected_menus" id="selected-menus-input">
            </div>

            <button type="submit" class="btn btn-primary mt-4">Submit Reservation</button>
        </form>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectedMenus = [];
        const selectedMenusInput = document.getElementById('selected-menus-input');
        const selectedMenusList = document.getElementById('selected-menus');

        document.querySelectorAll('.add-menu').forEach(button => {
            button.addEventListener('click', function () {
                const menuId = this.dataset.id;
                const menuName = this.dataset.name;
                const menuPrice = this.dataset.price;

                if (!selectedMenus.some(menu => menu.id === menuId)) {
                    selectedMenus.push({ id: menuId, name: menuName, price: menuPrice });

                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                    listItem.textContent = `${menuName} (Price: $${menuPrice})`;

                    const removeButton = document.createElement('button');
                    removeButton.className = 'btn btn-sm btn-danger';
                    removeButton.textContent = 'Remove';
                    removeButton.addEventListener('click', () => {
                        selectedMenus.splice(selectedMenus.findIndex(menu => menu.id === menuId), 1);
                        listItem.remove();
                        updateInputValue();
                    });

                    listItem.appendChild(removeButton);
                    selectedMenusList.appendChild(listItem);

                    updateInputValue();
                }
            });
        });

        function updateInputValue() {
            selectedMenusInput.value = JSON.stringify(selectedMenus);
        }
    });
</script>

@endsection
