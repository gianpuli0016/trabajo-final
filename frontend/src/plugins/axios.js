import axios from "axios";

//config axios

axios.defaults.baseURL = "http://localhost:8080";

const custom_axios = axios;

export default custom_axios;