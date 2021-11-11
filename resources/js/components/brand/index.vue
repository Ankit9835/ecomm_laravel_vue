<template>
    <div>
        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Add Brands
                                        </h1>
                                    </div>
                                    <form
                                        @submit.prevent="brandInsert"
                                        enctype="multipart/form-data"
                                    >
                                        <div class="form-row">
                                            <div class="col-sm-12">
                                                <input
                                                    type="file"
                                                    class="custom-file-input"
                                                    id="customFile"
                                                    @change="onFileSelected"
                                                />

                                                <label
                                                    class="custom-file-label"
                                                    for="customFile"
                                                    >Choose file</label
                                                >
                                            </div>
                                            <div class="col-sm-12">
                                                <img
                                                    :src="form.image"
                                                    style="height:40px; width:40px; "
                                                />
                                            </div>
                                        </div>

                                        <div class="form-row mt-3">
                                            <div class="col-sm-12">
                                                <label>
                                                    <strong>
                                                        Brand Name
                                                    </strong>
                                                </label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="exampleInputFirstName"
                                                    v-model="form.name"
                                                    placeholder="Enter Your Brand Name"
                                                />
                                            </div>
                                        </div>

                                        <div class="form-group mt-2">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                            >
                                                Submit
                                            </button>
                                        </div>
                                        <hr />
                                    </form>
                                    <hr />

                                    <div class="text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="col-lg-7 my-5">
                <!-- Simple Tables -->
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Brands List
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(brand, index) in filterSearch"
                                    :key="brand.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        <img :src="brand.image" id="em_photo" />
                                    </td>

                                    <td>
                                        <strong>{{ brand.name }}</strong>
                                    </td>

                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'edit-brand',
                                                params: { id: brand.id }
                                            }"
                                            class="btn btn-sm btn-primary"
                                            ><i
                                                class="fa fa-pencil-square-o"
                                                aria-hidden="true"
                                            ></i
                                        ></router-link>
                                        <a
                                            @click="deleteBrand(brand.id)"
                                            class="btn btn-sm btn-danger"
                                            ><i
                                                class="fas fa-trash-alt text-white"
                                            ></i
                                        ></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
    },

    data() {
        return {
            form: {
                name: null,
                image: null
            },
            brands: [],
            categories: [],
            errors: {},
            searchTerm: ""
        };
    },

    computed: {
        filterSearch() {
            return this.brands.filter(brand => {
                return brand.name.match(this.searchTerm);
            });
        }
    },

    created() {
        this.allBrand();
        Reload.$on("AfterAdd", () => {
            this.allBrand();
        });
    },

    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation();
            } else {
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.image = event.target.result;
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },

        brandInsert() {
            // console.log('test')
            axios
                .post("/api/brand", this.form)
                .then(() => {
                    Reload.$emit("AfterAdd");
                    //this.$router.push({name : 'category'})
                    Notification.success();
                })
                .catch(
                    error =>
                        (this.errors = console.log((error.response || {}).data))
                );
        },

        allBrand() {
            axios
                .get("/api/brand")
                .then(({ data }) => (this.brands = data))
                .catch();
        },

        deleteBrand(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/api/brand/" + id)
                        .then(() => {
                            this.brands = this.brands.filter(brand => {
                                return brand.id != id;
                            });
                        })
                        .catch(() => {
                            this.$router.push({ name: "brand" });
                        });
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                }
            });
        }
    }
};
</script>

<style type="text/css">
#em_photo {
    height: 60px;
    width: 60px;
}
</style>
