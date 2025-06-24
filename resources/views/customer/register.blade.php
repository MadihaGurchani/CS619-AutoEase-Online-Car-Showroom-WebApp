<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration - AutoEase</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">User Registration</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('register.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <select name="city" class="form-select" required>
                                        <option value="">Select City</option>
                                        <option value="Peshawar">Peshawar</option>
                                        <option value="Lahore">Lahore</option>
                                        <option value="Islamabad">Islamabad</option>
                                        <option value="Karachi">Karachi</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control" rows="2" required></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <hr class="my-4">
                                <h5 class="mb-3">Guarantor Information</h5>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Guarantor's Name</label>
                                    <input type="text" name="guarantor_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Guarantor's Phone</label>
                                    <input type="tel" name="guarantor_phone" class="form-control" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Guarantor's Address</label>
                                    <textarea name="guarantor_address" class="form-control" rows="2" required></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Guarantor's CNIC</label>
                                    <input type="text" name="guarantor_cnic" class="form-control" required>
                                </div>

                                <hr class="my-4">
                                <h5 class="mb-3">Bank Details</h5>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Bank Name</label>
                                    <input type="text" name="bank_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Account Name</label>
                                    <input type="text" name="account_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Account Number</label>
                                    <input type="text" name="account_number" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Branch Code</label>
                                    <input type="text" name="branch_code" class="form-control" required>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>