<script>
import { RouterLink, RouterView } from "vue-router";
import axios from "axios";

export default {
  data() {
    return {
      urlCurrency: "http://127.0.0.1:8000/api/currencies",
      urlPairs: "http://127.0.0.1:8000/api/pairs",
      urlConverts: "http://127.0.0.1:8000/api/converts",
      currency: [],
      pairs: [],
      converts: [],
    };
  },
  methods: {
    getCurrency() {
      axios.get(this.urlCurrency).then((data) => {
        this.currency = data["data"];
      });
    },
    getPairs() {
      axios.get(this.urlPairs).then((data) => {
        this.pairs = data["data"];
      });
    },
    getConverts() {
      axios.get(this.urlConverts).then((data) => {
        this.converts = data["data"];
      });
    },
    connexion(email, password) {
      if (password == "" || email == "") {
        window.alert("Mot de passe et/ou email ne doivent pas être vides!");
      } else {
        axios
          .post("http://127.0.0.1:8000/api/login", {
            email: email,
            password: password,
          })
          .then(({ data }) => {
            if (data["message"] == "User login successfully.") {
              localStorage.setItem("access_token", data["data"]["token"]);
              localStorage.setItem("nameAdmin", data["data"]["name"]);
              this.$router.push("/admin/currencies");
            }
          })
          .catch((error) => {
            window.alert("Mot de passe et/ou email incorrect!");
          });
      }
    },
    logout() {
      let token = localStorage.getItem("access_token");
      axios
        .post("http://127.0.0.1:8000/api/logout", null, {
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + token,
          },
        })
        .then(({ data }) => {
          this.$router.push("/login");
          localStorage.removeItem("nameAdmin");
          localStorage.removeItem("access_token");
        })
        .catch((error) => {
          window.alert("Vous ne pouvez pas vous déconnecter ");
        });
    },
  },
  created() {
    this.getCurrency();
    this.getPairs();
    this.getConverts();
  },
};
</script>

<template>
  <RouterView
    @getCurrency="getCurrency"
    @getPairs="getPairs"
    @getConverts="getConverts"
    @connexion="connexion"
    @logout="logout"
    :currency="currency"
    :pairs="pairs"
    :converts="converts"
    :urlCurrency="urlCurrency"
    :urlPairs="urlPairs"
    :urlConverts="urlConverts"
  />
</template>

<style scoped></style>
