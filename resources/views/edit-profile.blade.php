<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ asset('css/edit_profile.css') }}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Personal Information</h1>
            <form method="POST" enctype="multipart/form-data"
                action="{{ route('update-profile', ['id' => $personal_info->user_id]) }}">
                @csrf
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                        value="{{ $personal_info->first_name }}" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                        value="{{ $personal_info->last_name }}" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ $personal_info->address }}" required>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="{{ $personal_info->phone_number }}" required>
                </div>
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                        value="{{ $personal_info->date_of_birth }}" required>
                </div>
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                </div>
                <div class="mb-3">
                    <label for="quotes" class="form-label">Quotes</label>
                    <input type="text" class="form-control" id="quotes" name="quotes"
                        value="{{ $personal_info->quotes }}" required>
                </div>
                <div class="mb-3">
                    <label for="social_media_links" class="form-label">Social Media Links</label>
                    <textarea class="form-control" id="social_media_links" name="social_media_links" rows="3">{{ $personal_info->social_media_links }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Confirm</button>
                <a href="{{ route('profile') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </form>
        </div>
    </div>
</body>

</html>
