import Home from '../Pages/Home'
import ProductCreate from '../Pages/ProductCreate'
import ProductDetail from '../Pages/ProductDetail'
import NotFound from '../Pages/NotFound'
import Menu from '../Components/Layout/Menu'
import Container from 'react-bootstrap/Container'

import {
    BrowserRouter as Router,
    Routes,
    Route
} from 'react-router-dom'

function Public() {
    return (
        <Router>
            <Menu />
            <Container>
                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/producto/alta" element={<ProductCreate />} />
                    <Route path="/producto/:id" element={<ProductDetail />} />
                    <Route path="/*" element={<NotFound />} />
                </Routes>
            </Container>
        </Router>
    )
}

export default Public;