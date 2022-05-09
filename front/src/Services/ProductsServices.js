import axios from 'axios'

const url = "http://localhost:8088/public/productos/"

export function getProducts() {
    return axios.get(url)
}

export function getProductById(id) {
    return axios.get(url + id)
}

export function createProduct(data) {
   return axios.post(url, data)
}