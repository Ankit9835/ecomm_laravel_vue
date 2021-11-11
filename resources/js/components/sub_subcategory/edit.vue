<template>
    <div>
        <div class="row">
            <router-link to="/sub-sub-category" class="btn btn-primary">
                All Sub-Sub-Category
            </router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Sub Sub Category Update
                                        </h1>
                                    </div>
                                    <form @submit.prevent="subcategoryUpdate">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-sm-12">
                                                    <select
                                                        class="form-control"
                                                        id="exampleFormControlSelect1"
                                                        v-model="
                                                            form.category_id
                                                        "
                                                    >
                                                        <option
                                                            :value="category.id"
                                                            v-for="category in categories"
                                                            >{{
                                                                category.category_name
                                                            }}</option
                                                        >
                                                    </select>
                                                </div>
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

                                        <div class="form-group">
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
                category_id: "",
                sub_category_id: "",
                sub_sub_category_name: ""
            },
            errors: {},
            categories: {},
            subcategories: {}
        };
    },
    created() {
        this.getCategory();
        let id = this.$route.params.id;
        axios
            .get("/api/sub-subcategory" + id)
            .then(({ data }) => (this.form = data))
            .catch(console.log("error"));
    },
    methods: {
        getCategory: function() {
            axios.get("/api/category").then(
                function(response) {
                    this.categories = response.data;
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
        subcategoryUpdate() {
            let id = this.$route.params.id;
            axios
                .patch("/api/subcategory/" + id, this.form)
                .then(() => {
                    this.$router.push({ name: "subcategory" });
                    Notification.success();
                })
                .catch(error => (this.errors = error.response.data.errors));
        }
    }
};
</script>

<style type="text/css"></style>
