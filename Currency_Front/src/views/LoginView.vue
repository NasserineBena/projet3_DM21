<script>
import axios from "axios";
import AddAndEditCurrency from "@/components/AddAndEditCurrency.vue";
import AddAndEditPair from "@/components/AddAndEditPair.vue";
export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  emits: ["connexion", "logout"],
  methods: {
    connexion() {
      this.$emit("connexion", this.email, this.password);
    },
    logout() {
      this.$emit("logout");
    },
  },
  created() {},
};
</script>
<template>
  <div class="body">
    <div>
      <p class="titre">Connexion</p>
      <form @submit.prevent="connexion">
        <div class="fields">
          <div class="four wide field">
            <label>E-mail</label><br />
            <input
              type="email"
              name="email"
              placeholder="email"
              v-model="email"
            /><br />
            <label>Password</label><br />
            <input
              type="password"
              name="password"
              placeholder="password"
              v-model="password"
            /><br />
          </div>
          <div class="buttonCenter">
            <button type="submit" class="buttonConnexion">Connexion</button>
          </div>
        </div>
      </form>
      <button v-on:click.prevent="logout">Logout</button>
    </div>
  </div>
</template>
<style scoped>
.body {
  background-color: #f5f5f5;
  padding: 50px 40px 50px 40px;
  border-radius: 25px;
  font-size: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
}
label {
  color: #0080ff;
}
.titre {
  color: #0080ff;
  font-size: 30px;
  text-align: center;
  margin: 20px;
}
input {
  padding: 12px;
  min-width: 250px;
  border-radius: 5px;
  margin-top: 15px;
  margin-bottom: 15px;
}
.buttonCenter {
  display: flex;
  justify-content: center;
}
.buttonConnexion {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 30px;
  padding: 8px;
  border-radius: 8px;
  font-size: 15px;
  color: green;
}
</style>
