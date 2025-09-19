<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>USERSYNCDEMO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <h2 class="mb-4 text-center">USER SYNC DEMO</h2>
        <div class="mb-3 mt-5 d-flex">
            <input type="search" id="customSearch" name="search" class="form-control me-2"
                placeholder="Search by name or email">
            <button id="searchBtn" class="btn btn-primary me-2">Search</button>
            <button type="reset" id="resetBtn" class="btn btn-secondary">Clear</button>
        </div>
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="usersTable" class="table table-striped table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Single User -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">User Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="userDetails"></ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const url = "https://usersyncdemo.test/api";

        $(document).ready(function () {
            let table = $("#usersTable").DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 20],
                searching: false,
                language: { emptyTable: "No users found" },
                destroy: true
            });

            // Load users
            $.ajax({
                url: `${url}/users`,
                method: "GET",
                dataType: "json",
                success: function (response) {
                    table.clear();
                    if (!response.error && response.data.length > 0) {
                        populateTable(response);
                    }
                    table.draw();
                }
            });

            // Handle reset button click
            $("#resetBtn").on("click", function () {
                $("#customSearch").val('');
                location.reload();
            });

            // Handle search button click
            $("#searchBtn").on("click", function () {
                let query = $("#customSearch").val().trim();

                if (query) {
                    $.ajax({
                        url: `${url}/users?search=${query}`,
                        method: "GET",
                        dataType: "json",
                        success: function (response) {
                            table.clear();
                            if (!response.error && response.data.length > 0) {
                                populateTable(response);
                            }
                            table.draw();
                        },
                        error: function () {
                            alert("Error fetching users.");
                        }
                    });
                } else {
                    // If search is empty, reload full table
                    $.ajax({
                        url: `${url}/users`,
                        method: "GET",
                        dataType: "json",
                        success: function (response) {
                            table.clear();
                            if (!response.error && response.data.length > 0) {
                                populateTable(response);
                            }
                            table.draw();
                        }
                    });
                }
            });


            // Handle view button click
            $(document).on("click", ".viewUser", function () {
                let userId = $(this).data("id");

                $.ajax({
                    url: `${url}/users/${userId}`,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        if (!response.error) {
                            let user = response.data;

                            let details = `
                                <li class="list-group-item"><strong>Name:</strong> ${user.name}</li>
                                <li class="list-group-item"><strong>User ID:</strong> ${user.id}</li>
                                <li class="list-group-item"><strong>Username:</strong> ${user.username}</li>
                                <li class="list-group-item"><strong>Email:</strong> ${user.email}</li>
                                <li class="list-group-item"><strong>Phone:</strong> ${user.phone}</li>
                                <li class="list-group-item"><strong>Website:</strong> ${user.website}</li>

                                <li class="list-group-item"><strong>Address:</strong> 
                                    ${user.address.street}, 
                                    ${user.address.suite}, 
                                    ${user.address.city}, 
                                    ${user.address.zipcode} 
                                    <br><small><strong>Geo:</strong> Lat: ${user.address.geo.lat}, Lng: ${user.address.geo.lng}</small>
                                </li>

                                <li class="list-group-item"><strong>Company:</strong> 
                                    ${user.company.name} <br>
                                    <small><em>${user.company.catchPhrase}</em></small><br>
                                    <small>${user.company.bs}</small>
                                </li>
                            `;

                            $("#userDetails").html(details);
                            $("#userModal").modal("show");
                        }
                    }
                });
            });
            
            $(document).on("click", ".deleteUser", function () {
                let userId = $(this).data("id");
                $.ajax({
                    url: `${url}/users/${userId}`,
                    method: "DELETE",
                    dataType: "json",
                    data :{
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        alert(response.message);
                        window.location.reload();
                    },
                    error: function(response) {
                        alert("Unable to delete user");
                    }

                });
            });



            function populateTable(response) {
                $.each(response.data, function (index, user) {
                    table.row.add([
                        index + 1,
                        user.id,
                        user.name,
                        user.username,
                        user.email,
                        user.phone,
                        user.company.name,
                        user.address.city,
                        `<button class="btn btn-sm btn-primary viewUser" data-id="${user.id}">View</button>
                        <button class="btn btn-sm btn-danger deleteUser" onclick="confirm('Proceed to delete this user with ID: ${user.id}')" data-id="${user.id}">Delete</button>`
                    ]);
                });
            }

        });
    </script>

</body>

</html>