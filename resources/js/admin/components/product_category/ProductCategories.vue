<template>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">Categories</h4>
                        <a
                            href="/admin/product-category/create"
                            class="btn btn-primary btn-icon-split float-end"
                        >
                            <i class="fas fa-plus"></i>
                            Add
                        </a>
                    </div>
                    <div class="card-body">
                        <!-- table striped -->
                        <div class="table-responsive">
                            <table class="table table-striped text-center mb-0">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>ICON</th>
                                        <th>NAME</th>
                                        <th>PARENT</th>
                                        <th>TAGS</th>
                                        <th>FEATURED</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(product_category,
                                        index) in product_categories"
                                        :key="product_category.id"
                                    >
                                        <td width="5%">
                                            <b>{{ index + 1 }}</b>
                                        </td>
                                        <td width="10%">
                                            <img
                                                height="70px"
                                                :src="
                                                    `/storage/images/uploads/${product_category.icon}`
                                                "
                                            />
                                        </td>
                                        <td width="20%">
                                            <b>{{ product_category.name }}</b>
                                        </td>
                                        <td width="25%">
                                            {{
                                                product_category.parent_id
                                                    ? product_category.parent_level
                                                    : "--"
                                            }}
                                        </td>
                                        <td width="15%">
                                            <span
                                                v-if="product_category.status"
                                                class="badge rounded-pill bg-success"
                                                >Active</span
                                            >
                                            <span
                                                v-if="
                                                    product_category.is_featured
                                                "
                                                class="badge rounded-pill bg-secondary"
                                                >Featured</span
                                            >
                                        </td>
                                        <td width="10%">
                                            <div
                                                class="form-check-glow form-switch"
                                            >
                                                <input
                                                    class="form-check-input form-check-primary"
                                                    type="checkbox"
                                                    name="is_featured"
                                                    id="categroy-is-featured"
                                                    v-model="
                                                        product_category.is_featured
                                                    "
                                                    @change="
                                                        toogleStatusOrFeatured(
                                                            product_category
                                                        )
                                                    "
                                                />
                                            </div>
                                        </td>
                                        <td width="15%">
                                            <button
                                                @click="
                                                    editProductCategory(
                                                        product_category.id
                                                    )
                                                "
                                                class="btn btn-secondary btn-circle rounded-circle"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button
                                                @click="
                                                    deleteProductCategary(
                                                        product_category
                                                    )
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
export default {
    data() {
        return {
            product_categories: []
        };
    },

    mounted() {
        this.getAllProductCategories();
    },

    methods: {
        async getAllProductCategories() {
            let response = await axios.get(`/admin/product-category/get-all`);
            this.product_categories = response.data.data;
        },

        deleteProductCategary(category) {
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
                        .delete("/admin/product-category/" + category.id)
                        .then(response => {
                            if (response.data.success == true) {
                                this.$swal(
                                    "Deleted",
                                    "You successfully deleted this file",
                                    "success"
                                );
                            }
                            this.getAllProductCategories();
                        });
                }
            });
        },

        editProductCategory(category_id) {
            location.href = "/admin/product-category/" + category_id + "/edit";
        },

        async toogleStatusOrFeatured(category) {
            try {
                let payload = {
                    status: category.status,
                    is_featured: category.is_featured
                };
                let url = `/admin/product-category/${category.id}/toggle-status-or-featured`;
                let response = await axios.put(url, payload);
                if (response.data.success) {
                    this.notify(response.data.message, "Success", "success");
                }
            } catch (error) {
                this.errors = errors.response.data.errors;
                this.notify("Check Validation Errors", "Error", "success");
            }
        }
    }
};
</script>
