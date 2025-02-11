import axios from "axios";

const base_api_url = `${window.location.origin}/api/v1`;
// console.log(base_api_url)

export default {

  //AUTH
  getRegister:(data) => axios.post(`${base_api_url}/auth/register`, data),
  getLogin:(data) => axios.post(`${base_api_url}/auth/login`, data),
  getLogout:(data, token) => axios.post(`${base_api_url}/auth/logout`, data, token),

  //ROL ADMIN
  getUserAll:(token) => axios.get(`${base_api_url}/admin/user`, token),
  getUserById:(id,token) => axios.get(`${base_api_url}/admin/user/${id}`,token),
  getUserUpdate:(id, data, token) => axios.put(`${base_api_url}/admin/user/${id}`, data, token),

  //CATEGORY
  getCategoryAll:(token) => axios.get(`${base_api_url}/admin/category`, token),
  getCategoryStore:(data, token) => axios.post(`${base_api_url}/admin/category`, data, token),
  getCategoryById:(id,token) => axios.get(`${base_api_url}/admin/category/${id}`,token),
  getCategoryUpdate:(id, data, token) => axios.put(`${base_api_url}/admin/category/${id}`, data, token),
  getCategoryDelete:(id,token) => axios.delete(`${base_api_url}/admin/category/${id}`,token)
}