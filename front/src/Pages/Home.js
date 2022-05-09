import React, { useState, useEffect } from 'react'
import { getProducts } from "../Services/ProductsServices"
import Product from "../Components/Layout/Product"
import Loader from "../Components/Loader"
import { Button, Row, Alert } from 'react-bootstrap'
import { Link } from 'react-router-dom'

function Home(props) {
    const [products, setProducts] = useState([])
    const [loader, setLoader] = useState(true)

    useEffect(
        ()=>{

            const request = async ()=>{
                try{
                    const response = await getProducts()
                    if (response.data.success) {
                        setProducts(response.data.data)
                        setLoader(false)
                    }
                }catch(e){
                    setLoader(false)
                    console.log(e)
                }
            }
            request()
        },
        []
    )

    return(
        <Loader loader={loader} configuration={{animation:"border", variant:"primary"}}>            
            <h1>Productos</h1>
            <Button variant="primary" as={Link} to={"/producto/alta"}>Nuevo producto</Button>
            <div className="grid">
                {products.length === 0 && 
                    <Alert key={"info"} variant={"info"}>
                        No existen registros de productos. 
                    </Alert>
                }
                <Row xs={"auto"} md={"auto"}>
                    {products.map(product=><Product datos={{...product, id:product.id}} key={product.id}/>)}
                </Row>
            </div>
        </Loader>
    )

}
export default Home
