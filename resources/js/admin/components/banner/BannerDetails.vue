<template>
    <section class="section">
        <!-- Vertically Centered modal to add banner images -->
        <div
            class="modal modal-borderless fade"
            id="addBannerModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addBannerModalTitle"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                role="document"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBannerModalTitle">
                            Banner Image Form
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
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="banner-image">Image</label>
                                <div class="col-sm-10">
                                    <button
                                        class="btn btn-outline-primary"
                                        @click="$refs.imageInput.click()"
                                    >
                                        <i class="bi bi-cloud-arrow-up-fill"></i
                                        >&nbsp; Upload Image
                                    </button>
                                    <input
                                        ref="imageInput"
                                        type="file"
                                        id="banner-image"
                                        class="form-control d-none"
                                        v-on:change="onImageUpload"
                                        accept="image/*"
                                    />
                                </div>
                            </div>

                            <div
                                class="form-group col-12 d-flex justify-content-center"
                                v-if="image_preview"
                            >
                                <img
                                    :src="image_preview"
                                    class="img-thumbnail"
                                    style="max-height: 250px"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="banner-image-link">Link</label>
                                    <input
                                        type="text"
                                        id="banner-image-link"
                                        class="form-control"
                                        name="link"
                                        placeholder="Link"
                                        v-model="banner_image.link"
                                    />
                                    <span
                                        class="text-danger text-sm"
                                        v-if="errors.has('link')"
                                        >{{ errors.first("link") }}</span
                                    >
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mt-2 form-group">
                                    <div class="form-check-glow form-switch">
                                        <input
                                            class="form-check-input form-check-primary"
                                            type="checkbox"
                                            id="image-status"
                                            name="is_featured"
                                            v-model="banner_image.status"
                                        />&nbsp;&nbsp;&nbsp;
                                        <label
                                            class="form-check-label"
                                            for="image-status"
                                            >Status</label
                                        >
                                    </div>
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
                            @click="this.onBannerImageSubmit"
                            type="button"
                            class="btn btn-primary ml-1"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Vertically Centered modal to add banner images -->

        <div class="row">
            <div class="col-md-4 col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">Banner Image</h4>
                    </div>
                    <div class="card-body">
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
                    <div class="col-12 d-flex justify-content-end">
                        <button
                            @click="onBannerUpdate()"
                            type="submit"
                            class="btn btn-outline-primary me-4 mb-3"
                        >
                            Update
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">Images</h4>
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
                                        <th>IMAGE</th>
                                        <th>LINK</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(image, index) in this.banner
                                            .banner_images"
                                        :key="image.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>
                                            <img
                                                height="70px"
                                                :src="
                                                    `/storage/images/uploads/${image.name}`
                                                "
                                            />
                                        </td>
                                        <td>
                                            {{ image.link ? image.link : "--" }}
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-secondary btn-circle rounded-circle"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button
                                                @click="
                                                    onBannerImageDelete(image)
                                                "
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
    props: ["banner_id"],
    data() {
        return {
            banner: {},
            banner_images: [],
            banner_image: {
                image: "",
                link: "",
                status: true
            },
            image_preview: ""
        };
    },

    mounted() {
        this.getBannerDetail();
    },

    methods: {
        async getBannerDetail() {
            let response = await axios.get(`/admin/banner/${this.banner_id}`);
            this.banner = response.data.data;
        },

        async onBannerUpdate() {
            let result = await this.$validator.validateAll();
            if (!result) {
                return;
            }
            try {
                // let payload = this.convertObjectToFormData(this.banner);
                let url = `/admin/banner/${this.banner_id}`;
                let response = await axios.put(url, this.banner);
                if (response.data.success) {
                }
                this.getBannerDetail();
            } catch (error) {
                renderServerErrors(this.errors, error);
            }
        },

        onImageUpload(e) {
            let image = e.target.files[0];
            this.banner_image.image = image;
            this.image_preview = URL.createObjectURL(image);
        },

        async onBannerImageSubmit() {
            try {
                let payload = this.convertObjectToFormData(this.banner_image);
                let url = `/admin/banner/${this.banner.id}/banner-image`;
                // if (this.brand_details) {
                //     url = `/admin/brand/${this.brand_details.id}`;
                //     payload.append("_method", "PATCH");
                // }
                let response = await axios.post(url, payload);
                if (response.data.success) {
                    $("#addBannerModal").modal("hide");
                }
                this.getBannerDetail();
            } catch (error) {
                renderServerErrors(this.errors, error);
            }
        },

        onBannerImageDelete(banner_image) {
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
                        .delete(
                            `/admin/banner/${this.banner.id}/banner-image/${banner_image.id}`
                        )
                        .then(response => {
                            if (response.data.success == true) {
                                this.$swal(
                                    "Deleted",
                                    "You successfully deleted this file",
                                    "success"
                                );
                            }
                            this.getBannerDetail();
                        });
                }
            });
        }
    }
};
</script>
