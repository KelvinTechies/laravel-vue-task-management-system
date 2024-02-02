<script>
import axios from "axios";
import Loading from "../Loading.vue";
export default {
  name: "Login",
  components: { Loading },
  data() {
    return {
      datas: {
        email: "",
        password: "",
      },
      isLoading: false,
      isLoadingTitle: "Loading",
    };
  },

  mounted() {},

  methods: {
    async loginUser() {
      if (this.datas.email == "") {
        this.$toast.error("The Email Field is required");
      } else if (this.datas.password == "") {
        this.$toast.error("The Password Field is required");
      }
      await axios.get("http://localhost:8000/sanctum/csrf-cookie");
      await axios
        .post("http://localhost:8000/api/login", this.datas)
        .then((res) => {
          if (res.data.status == 200) {
            this.isLoading = true;
            localStorage.setItem("auth_t", res.data.token);
            this.$router.push({ name: "createTask" });
          } else if (res.data.status == 401) {
            alert("User not found");
          } else if (res.data.status == 422) {
            this.$toast.error(res.data.errors.email);
            this.$router.push({ name: "Login" });
          }
        });
    },
  },
};
</script>

<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 mx-auto bg-light">
        <form @submit.prevent="loginUser">
          <fieldset>
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

            <div class="d-grid gap-2">
              <div v-if="isLoading">
                <Loading title="Please Wait" />
              </div>
              <div v-else>
                <button class="btn btn-lg btn-primary mt-4 mb-3" type="submit">
                  {{ isLoading ? "Please wait Logging you in" : "Login" }}
                </button>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</template>
