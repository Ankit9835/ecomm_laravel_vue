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
                                            Add Sub Sub Category
                                        </h1>
                                    </div>
                                    <form
                                        @submit.prevent="subsubcategoryInsert"
                                    >
                                        <div class="form-row">
                                            <div class="col-sm-12">
                                                <label>
                                                    <strong>
                                                        Select Category
                                                    </strong>
                                                </label>
                                                <select
                                                    class="form-control"
                                                    id="exampleFormControlSelect1"
                                                    v-model="form.category_id"
                                                    @change="onChange($event)"
                                                >
                                                    <option
                                                        v-for="data in categories"
                                                        :value="data.id"
                                                        >{{
                                                            data.category_name
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-sm-12">
                                                <label>
                                                    <strong>
                                                        Select Sub Category
                                                    </strong>
                                                </label>
                                                <select
                                                    v-model="
                                                        form.sub_category_id
                                                    "
                                                    class="form-control"
                                                >
                                                    <option
                                                        v-for="data in subcategories"
                                                        :value="data.id"
                                                        >{{
                                                            data.sub_category_name
                                                        }}</option
                                                    >
                                                    >
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row mt-3">
                                            <div class="col-sm-12">
                                                <label>
                                                    <strong>
                                                        Sub Sub Category Name
                                                    </strong>
                                                </label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="exampleInputFirstName"
                                                    v-model="
                                                        form.sub_sub_category_name
                                                    "
                                                    placeholder="Enter Your Sub Sub Category"
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
                            All Sub Sub Category
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>
                                        Sub Sub Category Name
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(subcategory, index) in filterSearch"
                                    :key="subcategory.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        <strong>{{
                                            subcategory.category.category_name
                                        }}</strong>
                                    </td>

                                    <td>
                                        <strong>{{
                                            subcategory.sub_category
                                                .sub_category_name
                                        }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{
                                            subcategory.sub_sub_category_name
                                        }}</strong>
                                    </td>

                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'editsubsubcategory',
                                                params: { id: subcategory.id }
                                            }"
                                            class="btn btn-sm btn-primary"
                                            ><i
                                                class="fa fa-pencil-square-o"
                                                aria-hidden="true"
                                            ></i
                                        ></router-link>
                                        &nbsp;
                                        <a
                                            @click="
                                                deleteSubSubCategory(
                                                    subcategory.id
                                                )
                                            "
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
                category_id: null,
                sub_category_id: null,
                sub_sub_category_name: null
            },
            subcategories: [],
            categories: [],
            subsubcategories: [],
            errors: {}
        };
    },

    computed: {
        filterSearch() {
            return this.subsubcategories.filter(subcategory => {
                return subcategory.sub_sub_category_name.match(this.searchTerm);
            });
        }
    },

    methods: {
        getCategory: function() {
            axios.get("/api/category").then(
                function(response) {
                    this.categories = response.data;
                }.bind(this)
            );
        },
        getSubSubCategory: function() {
            axios.get("/api/sub-subcategory").then(
                function(response) {
                    this.subsubcategories = response.data;
                }.bind(this)
            );
        },
        onChange(event) {
            console.log(event.target.value);
            let id = event.target.value;
            axios
                .get("/api/category/subcategory/ajax/" + id)
                .then(({ data }) => (this.subcategories = data))
                .catch(console.log("error"));
        },
        subsubcategoryInsert() {
            axios
                .post("/api/sub-subcategory", this.form)
                .then(() => {
                    Reload.$emit("AfterAdd");
                    //this.$router.push({name : 'category'})
                    Notification.success();
                })
                .catch(error => (this.errors = error.response.data.errors));
        }
    },

    created() {
        this.getCategory();
        this.getSubSubCategory();
        Reload.$on("AfterAdd", () => {
            this.getSubSubCategory();
        });
    }
};
</script>

<style type="text/css"></style>
