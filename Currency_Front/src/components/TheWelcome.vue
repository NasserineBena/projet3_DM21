<script>
import axios from "axios";
//const varEnv  = procces.env.SERVER_URL;

// const instance = axios.create({
//   baseURL: "https://domaine.com/api/", //point d'entrée de l'api
//   timeout: 1000,
//   headers: {
//     "Content-type": "",
//   },
// });

//const req1 = instance.baseURL.get("search/tweets.json");
// const req4 = axios.get("https://api.twitter.com/1.1/search/tweets.json");
// const req2 = axios.get(
//   "https://streaming-graph.facebook.com/12545265/live_comments"
// );
// const req3 = axios.get(
//   "https://api.instagram.com/v1/self/media/recent?access_token=asg5gx9ho5yyg2fs"
// );
export default {
  data() {
    return {
      url: "http://127.0.0.1:8000/api/currencies",
      currency: [],
      name: "",
      value: 0,
    };
  },
  methods: {
    getCurrency() {
      axios.get(this.url).then((data) => {
        this.currency = data["data"];
      });
    },
    createCurrency() {
      console.log(this.name, this.value);
      axios
        .post(this.url, {
          name: this.name,
          value_in_USD: this.value,
        })
        .then(() => {
          console.log();
        })
        .catch((e) => {
          alert(e);
        });
    },
  },
  created() {
    this.getCurrency();
  },
};
</script>

<template>
  <div class="data">
    {{ currency }}
  </div>
  <div class="my-form">
    <form class="ui form" @submit.prevent="createCurrency">
      <div class="fields">
        <div class="four wide field">
          <label>Currency</label>
          <input type="text" name="name" placeholder="Name" v-model="name" />
        </div>
        <div class="six wide field">
          <label>Value</label>
          <input
            type="number"
            name="value"
            placeholder="value"
            v-model="value"
          />
        </div>

        <div class="two wide field">
          <button type="submit">submit</button>
        </div>
      </div>
    </form>
  </div>
</template>
