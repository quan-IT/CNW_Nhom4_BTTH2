<div class="account-container">
    <h2 class="section-title">Account</h2>

    <div class="account-card">

        <!-- Avatar Section -->
        <div class="avatar-section">
            <img src="assets/img/avatar-default.jpg" class="avatar-img" alt="Avatar">

            <div class="avatar-actions">
                <button class="btn btn-update">Update</button>
                <button class="btn btn-delete">Delete</button>
            </div>

            <p class="avatar-note">PNG hoặc JPG, kích thước tối đa 800px.</p>
        </div>

        <hr>

        <!-- Personal Info -->
        <h3 class="sub-title">Personal Details</h3>
        <p class="sub-desc">Update your profile information.</p>

        <form class="profile-form">

            <div class="form-row">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" placeholder="First Name">
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" placeholder="Last Name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" placeholder="Phone">
                </div>

                <div class="form-group">
                    <label>Birthday</label>
                    <input type="date">
                </div>
            </div>

            <div class="form-group full">
                <label>Address Line 1</label>
                <input type="text" placeholder="Address">
            </div>

            <div class="form-group full">
                <label>Address Line 2</label>
                <input type="text" placeholder="Address">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>State</label>
                    <select>
                        <option>Select State</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Country</label>
                    <select>
                        <option>Select Country</option>
                    </select>
                </div>
            </div>

            <button class="btn btn-primary update-btn">Update Profile</button>

        </form>
    </div>
</div>