import { useEffect, useState } from 'react'
import { useParams, Link } from 'react-router-dom'
import { getProductById } from '../Services/ProductsServices'
import { Button } from 'react-bootstrap'
import Loader from "../Components/Loader"
import { useNavigate } from 'react-router-dom'


function ProductDetail() {
    const [loader, setLoader] = useState(true)
    const {id} = useParams()
    const [product, setProduct] = useState({})
    const navigation = useNavigate()

    useEffect(
        ()=>{
            const request = async ()=>{
                try{
                   const response = await getProductById(id)
                    if (response.data.success) {
                        setProduct(response.data.data)
                        setLoader(false)
                    }
                }catch(e){
                    if (e.response.status === 404) {
                        navigation("/")
                    }
                }
            }
            request()

        },
        [id, navigation]
    )

    return (
        <Loader loader={loader} configuration={{animation:"border", variant:"primary"}}>
            {product.nombre && <h1>{product.nombre}</h1>}
            {product.categoria && <h3>{product.categoria}</h3>}
            {product.sku && <h5>SKU: {product.sku}</h5>}
            {product.marca && <p>Marca: {product.marca}</p>}
            {product.costo && <p>Costo: <b>$ {product.costo}</b></p>}
            {product.venta && <p>Venta: <b>$ {product.venta}</b></p>}
            {product.tamanioPantalla && <p>Tamaño pantalla: {product.tamanioPantalla}</p>}
            {product.tipoPantalla && <p>Tipo pantalla: {product.tipoPantalla}</p>}
            {product.material && <p>Material: {product.material}</p>}
            {product.talle && <p>Talle: {product.talle}</p>}
            {product.procesador && <p>Procesador: {product.procesador}</p>}
            {product.memoriaRam && <p>Memoria RAM: {product.memoriaRam}</p>}
            <Button variant="primary" as={Link} to={"/"}>Volver</Button>
        </Loader>
    )

}

export default ProductDetail
