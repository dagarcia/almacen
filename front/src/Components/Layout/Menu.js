import {Link} from "react-router-dom"
import {Navbar, Nav, NavDropdown} from 'react-bootstrap'

function Menu() {
    return(
        <Navbar bg="light" expand="lg">
            <Navbar.Brand as={Link} to="/">Almacén</Navbar.Brand>
            <Navbar.Toggle aria-controls="basic-navbar-nav" />
            <Navbar.Collapse id="basic-navbar-nav">
                <Nav className="me-auto">
                <NavDropdown title="Productos" id="basic-nav-dropdown">
                    <NavDropdown.Item as={Link} to="/">Listado</NavDropdown.Item>
                    <NavDropdown.Item as={Link} to="/producto/alta">Crear producto</NavDropdown.Item>
                </NavDropdown>
                </Nav>
            </Navbar.Collapse>
        </Navbar>
    )
}

export default Menu;