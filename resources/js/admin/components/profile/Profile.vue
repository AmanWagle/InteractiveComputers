<template>
    <section class="section">
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div
                            class="user-img col-12 d-flex justify-content-center"
                        >
                            <img
                                src="/storage/images/static/profileImage.jpg"
                                class="img-thumbnail"
                                style="max-height: 170px"
                            />
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="lead"><b>Dummy Name</b></h5>
                            <p>amanwagle10@gmail.com</p>
                        </div>
                        <div
                            class="nav flex-column nav-pills"
                            id="v-pills-tab"
                            role="tablist"
                            aria-orientation="vertical"
                        >
                            <a
                                class="nav-link active"
                                id="v-pills-detail-tab"
                                data-toggle="pill"
                                href="#v-pills-detail"
                                role="tab"
                                aria-controls="v-pills-detail"
                                aria-selected="true"
                                >Profile Details</a
                            >
                            <a
                                class="nav-link"
                                id="v-pills-security-tab"
                                data-toggle="pill"
                                href="#v-pills-security"
                                role="tab"
                                aria-controls="v-pills-security"
                                aria-selected="false"
                                >Security</a
                            >
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div
                        class="tab-pane fade show active"
                        id="v-pills-detail"
                        role="tabpanel"
                        aria-labelledby="v-pills-detail-tab"
                    >
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title">Profile Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input
                                                    type="text"
                                                    id="name"
                                                    class="form-control"
                                                    name="name"
                                                    placeholder="Name"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input
                                                    type="email"
                                                    id="email"
                                                    class="form-control"
                                                    name="email"
                                                    placeholder="Email"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="col-sm-12 d-flex justify-content-end"
                                    >
                                        <button
                                            type="submit"
                                            class="btn btn-primary mt-2 me-1 mb-1"
                                        >
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="tab-pane fade"
                        id="v-pills-security"
                        role="tabpanel"
                        aria-labelledby="v-pills-security-tab"
                    >
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title">Change Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="current_password">Current Password</label>
                                                <input
                                                    type="password"
                                                    id="current_password"
                                                    class="form-control"
                                                    name="current_password"
                                                    placeholder="Current Password"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="new_password">New Password</label>
                                                <input
                                                    type="password"
                                                    id="new_password"
                                                    class="form-control"
                                                    name="new_password"
                                                    placeholder="New Password"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input
                                                    type="password"
                                                    id="confirm_password"
                                                    class="form-control"
                                                    name="confirm_password"
                                                    placeholder="Confirm Password"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="col-sm-12 d-flex justify-content-end"
                                    >
                                        <button
                                            type="submit"
                                            class="btn btn-primary mt-2 me-1 mb-1"
                                        >
                                            Update Password
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
