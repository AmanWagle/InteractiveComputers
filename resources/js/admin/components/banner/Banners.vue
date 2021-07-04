<template>
    <section class="section">
        <!-- Vertically Centered modal to add banners -->
        <div
            class="modal modal-borderless fade"
            id="addBannerModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addBannerModalTitle"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                role="document"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBannerModalTitle">
                            Add Banner
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="banner-name">Banner Name</label>
                                <input
                                    type="text"
                                    id="banner-name"
                                    class="form-control"
                                    name="name"
                                    placeholder="Banner Name"
                                    v-model="banner.name"
                                    v-validate="'required'"
                                />
                                <span
                                    class="text-danger text-sm"
                                    v-if="errors.has('name')"
                                    >{{ errors.first("name") }}</span
                                >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mt-4 form-group">
                                <div class="form-check-glow form-switch">
                                    <input
                                        class="form-check-input form-check-primary"
                                        type="checkbox"
                                        id="banner-status"
                                        name="is_featured"
                                        v-model="banner.status"
                                    />&nbsp;&nbsp;&nbsp;
                                    <label
                                        class="form-check-label"
                                        for="banner-status"
                                        >Status</label
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-light-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary ml-1"
                            data-bs-dismiss="modal"
                            @click="saveBanner"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Vertically Centered modal to add banners -->

        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">Banners</h4>
                        <button
                            type="button"
                            class="btn btn-primary btn-icon-split float-end block"
                            data-bs-toggle="modal"
                            data-bs-target="#addBannerModal"
                        >
                            <i class="fas fa-plus"></i>
                            Add
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- table striped -->
                        <div class="table-responsive">
                            <table class="table table-striped text-center mb-0">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>NAME</th>
                                        <th>SLUG</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(banner, index) in banners"
                                        :key="banner.id"
                                    >
                                        <td width="5%">
                                            <b>{{ index + 1 }}</b>
                                        </td>
                                        <td>
                                            <b>{{ banner.name }}</b>
                                        </td>
                                        <td>
                                            {{ banner.slug }}
                                        </td>
                                        <td>
                                            <button
                                                @click="editBanner(banner.id)"
                                                class="btn btn-secondary btn-circle rounded-circle"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button
                                                @click="deleteBanner(banner)"
                                                class="btn btn-danger btn-circle rounded-circle"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { renderServerErrors } from "../../utils";

export default {
    data() {
        return {
            banners: [],
            banner: {
                name: "",
                status: 1
            }
        };
    },

    mounted() {
        this.getAllBanners();
    },

    methods: {
        async getAllBanners() {
            let response = await axios.get(`/admin/banner/get-all`);
            this.banners = response.data.data;
        },

        async saveBanner() {
            let result = await this.$validator.validateAll();
            if (!result) {
                return;
            }
            try {
                let payload = this.convertObjectToFormData(this.banner);
                let url = `/admin/banner`;
                let response = await axios.post(url, payload);
                if (response.data.success) {
                }
                this.getAllBanners();
            } catch (error) {
                renderServerErrors(this.errors, error);
            }
        },

        editBanner(banner_id) {
            location.href = `/admin/banner/${banner_id}/edit`;
        },

        deleteBanner(banner) {
            this.$swal({
                title: "Are you sure?",
                text: "You can't revert  your action",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes Delete it!",
                cancelButtonText: "No, Keep it!",
                showCloseButton: true
            }).then(result => {
                if (result.value) {
                    axios
                        .delete(`/admin/banner/${banner.id}`)
                        .then(response => {
                            if (response.data.success == true) {
                                this.$swal(
                                    "Deleted",
                                    "You successfully deleted this file",
                                    "success"
                                );
                            }
                            this.getAllBanners();
                        });
                }
            });
        }
    }
};
</script>
