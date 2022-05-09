import "./Product.css"
import { Link } from "react-router-dom"
import { Card, Button, Col, Badge } from 'react-bootstrap'

function Product(props) {
    const product = props.datos

    return(
        <Col>
            <Card>
                <Card.Body>
                    <Card.Title>{product.nombre}</Card.Title>
                    <Card.Subtitle>SKU: {product.sku}</Card.Subtitle>
                    <Badge bg="success">{product.categoria}</Badge>
                    <Card.Text>
                        Precio: <b>$ {product.venta}</b>
                    </Card.Text>
                    <Button variant="secondary" as={Link} to={'/producto/'+product.id}>Ver Detalle</Button>
                </Card.Body>
            </Card>
        </Col>
    )
}

export default Product
