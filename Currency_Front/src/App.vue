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
      console.log(email, password);
      axios
        .post("http://127.0.0.1:8000/api/login", {
          email: email,
          password: password,
        })
        .then(({ data }) => {
          if (data["message"] == "User login successfully.") {
            console.log(data["data"]["token"]);
            // localStorage.setItem("acces_token", data["data"]["token"].split("")[1]);
            localStorage.setItem("access_token", data["data"]["token"]);
            localStorage.setItem("nameAdmin", data["data"]["name"]);
            this.$router.push("/admin");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    logout() {
      // const config = {
      //       method: 'post',
      //       url: 'http://127.0.0.1:8000/api/logout',
      //       headers: {
      //           'Authorization': 'basic T64Mdy7m['
      //       }
      //   };
      let token = localStorage.getItem("access_token");
      // console.log(`Bearer ${token}`);
      console.log({
        Authorization: "Bearer " + token,
      }),
        axios
          .post("http://127.0.0.1:8000/api/logout", null, {
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + token,
            },
          })
          .then(({ data }) => {
            localStorage.removeItem("nameAdmin");
            localStorage.removeItem("access_token");
          })
          .catch((error) => {
            console.log(error);
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
