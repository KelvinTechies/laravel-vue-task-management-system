<script>
import axios from "axios";

export default {
  name: "RegisterComponent",
  data() {
    return {
      datas: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      isLoading: false,
      isLoadingTitle: "Loading",
    };
  },

  methods: {
    async registerUser() {
      try {
        if (this.datas.name == "") {
          this.$toast.error("The Name Field is required");
        } else if (this.datas.email == "") {
          this.$toast.error("The Email Field is required");
        } else if (this.datas.password == "") {
          this.$toast.error("The password Field is required");
        } else if (this.datas.password_confirmation == "") {
          this.$toast.error("The confrimation password Field is required");
        } else if (this.datas.password !== this.datas.password_confirmation) {
          this.$toast.warning("The Password Mixmatched");
        } else {
          this.isLoading = true;
          this.isLoadingTitle = "Please Wait";
          await axios
            .post("http://localhost:8000/api/register", this.datas)
            .then((res) => {
              console.log(res.data, "res");
              console.log(res.data);
              (this.isLoading = false),
                (this.isLoadingTitle = "Loading"),
                (this.datas.name = "");
              this.datas.email = "";
              this.datas.password = "";
              this.datas.password_confirmation = "";
            });
        }
      } catch (error) {
        console.log("regiater failed...", error);
      }
    },
  },
};
</script>

<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 mx-auto bg-light">
        <form @submit.prevent="registerUser()">
          <fieldset>
            <div class="form-group">
              <label for="name" class="form-label mt-4 text-dark">
                Fullname</label
              >
              <input
                type="text"
                class="form-control"
                id="name"
                aria-describedby="emailHelp"
                placeholder="Enter Fullname"
                v-model="datas.name"
              />
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1" class="form-label mt-4 text-dark"
                >Email address</label
              >
              <input
                type="email"
                class="form-control"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                placeholder="Enter email"
                v-model="datas.email"
              />
            </div>
            <div class="form-group">
              <label
                for="exampleInputPassword1"
                class="form-label mt-4 text-dark"
                >Password</label
              >
              <input
                type="password"
                class="form-control"
                id="exampleInputPassword1"
                placeholder="Password"
                autocomplete="off"
                v-model="datas.password"
              />
            </div>
            <div class="form-group">
              <label for="ConfirmPassword" class="form-label mt-4 text-dark"
                >Confirm Password</label
              >
              <input
                type="password"
                class="form-control"
                id="ConfirmPassword"
                placeholder="Confirm Password"
                autocomplete="off"
                v-model="datas.password_confirmation"
              />
            </div>

            <div class="d-grid gap-2">
              <button class="btn btn-lg btn-primary mt-4 mb-3" type="submit">
                Register
              </button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</template>
