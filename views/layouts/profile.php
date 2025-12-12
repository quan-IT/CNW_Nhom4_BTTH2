<div class="account-container">
    <h2 class="section-title">Account</h2>

    <div class="account-card">
        <!-- Avatar Section -->
        <div class="avatar-section">
            <img id="avatarPreview" src="assets/img/avatar-default.jpg" class="avatar-img" alt="Avatar">

            <div class="avatar-actions">
                <button type="button" id="btnUpdateAvatar" class="btn btn-update">Update</button>
                <button type="button" id="btnDeleteAvatar" class="btn btn-delete">Delete</button>
            </div>

            <p class="avatar-note">PNG hoặc JPG, kích thước tối đa 800x800px.</p>
            <div id="avatarError" class="error-message"></div>
        </div>

        <hr>

        <!-- Personal Info -->
        <h3 class="sub-title">Personal Details</h3>
        <p class="sub-desc">Update your profile information.</p>

        <form id="profileForm" class="profile-form" novalidate>

            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
                    <div class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
                    <div class="error-message"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                    <div class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <div class="error-message"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="oldPassword">Old Password</label>
                    <input type="password" id="oldPassword" name="oldPassword">
                    <div class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" id="newPassword" name="newPassword">
                    <div class="error-message"></div>
                </div>
            </div>

            <button type="submit" id="btnSubmitProfile" class="btn btn-primary update-btn">Update Profile</button>
        </form>
    </div>
</div>

<!-- Toast Container - BẮT BUỘC PHẢI CÓ -->
<div id="toastContainer"></div>

<!-- Load JS (đặt cuối trang) -->
<script src="assets/js/student/profile.js"></script>