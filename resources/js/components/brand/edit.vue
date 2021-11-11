<template>
    <div>
        <div class="row">
            <router-link to="/category" class="btn btn-primary">
                All Category
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
                                            Brand Update
                                        </h1>
                                    </div>
                                    <form
                                        @submit.prevent="brandUpdate"
                                        enctype="multipart/form-data"
                                    >
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
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

                                                <div class="col-md-6">
                                                    <img
                                                        :src="form.newimage"
                                                        style="height: 40px; width: 40px;"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-sm-12">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputFirstName"
                                                        v-model="form.name"
                                                        placeholder="Enter Your Brand Name"
                                                    />
                                                </div>
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
                name: "",
                image: "",
                newimage: ""
            },
            errors: {},
            categories: {}
        };
    },
    created() {
        let id = this.$route.params.id;
        console.log(id);
        axios.get("/api/brand/" + id).then(({ data }) => (this.form = data));
        //.catch(console.log(error));

        // Category Collected
        axios
            .get("/api/category/")
            .then(({ data }) => (this.categories = data));
    },

    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation();
            } else {
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.newimage = event.target.result;
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },

        brandUpdate() {
            let id = this.$route.params.id;
            axios.patch("/api/brand/" + id, this.form).then(() => {
                this.$router.push({ name: "brand" });
                Notification.success();
            });
            // .catch(error => (this.errors = error.response.data.errors));
        }
    }
};
</script>

<style type="text/css"></style>
