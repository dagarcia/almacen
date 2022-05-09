import "./ProductCreate.css"
import { useState } from 'react'
import { useForm } from 'react-hook-form'
import FormGroup from '../Components/Forms/Elements/FormGroup'
import { createProduct } from '../Services/ProductsServices'
import ButtonLoader from '../Components/Forms/Elements/ButtonLoader'
import Alert from 'react-bootstrap/Alert'
import { useNavigate } from 'react-router-dom'



function ProductCreate(){

    const {register, handleSubmit, formState: { errors } } = useForm()
    const [loader, setLoader] = useState(false)
    const navigate = useNavigate()

    const processorOptions = ["Intel", "AMD"]
    const materialOptions = ["Piel", "Plástico"]
    const displayOptions = ["LCD", "LED", "OLED"]
    const categoriesOptions = ["Televisor", "Laptop", "Zapatos"]
    const [selectedCategorie, setSelectedCategorie] = useState(categoriesOptions[0]);
    const [errorMessage, setErrorMessage] = useState(null)

    const onSubmit = async (data) => {
        try {
            setLoader(true)
            const response = await createProduct(data)
            setLoader(false)
            if (response.data.success) {
                navigate('/')
            } else {
                setErrorMessage(response.data.error)
                window.scrollTo(0, 0);
            }
            
        }catch(e) {
            console.log(e.code)
            setLoader(false)
        }

    }

    return(
        <div>
            <h2>Nuevo Producto</h2>
            { errorMessage !== null &&
                <Alert key={"danger"} variant={"danger"}>
                    {errorMessage}
                </Alert>
            }
            <form onSubmit={handleSubmit(onSubmit)}>

                <FormGroup label="Categoria" onChange={(e) => setSelectedCategorie(e.target.value)} type="select" options={categoriesOptions} register={{...register('categoria', {required:true})}} helpText="* Seleccione una opción"/>

                <FormGroup label="Nombre" register={{...register('nombre', {required:true, maxLength:150})}} />
                {errors.nombre?.type==='required' && <div><small><span className="text-danger">El campo "Nombre" es obligatorio</span></small></div>}
                {errors.nombre?.type==='maxLength' && <div><small><span className="text-danger">El campo "Nombre" debe tener como máximo 150 caracteres</span></small></div>}
 
                <FormGroup label="SKU" register={{...register('sku', {required:true, maxLength:20})}} helpText="Número de referencia único"/>
                {errors.sku?.type==='required' && <div><small><span className="text-danger">El campo "SKU" es obligatorio</span></small></div>}
                {errors.sku?.type==='maxLength' && <div><small><span className="text-danger">El campo "SKU" debe tener como máximo 20 caracteres</span></small></div>}

                <FormGroup label="Marca" register={{...register('marca', {required:true, maxLength:30})}} />
                {errors.marca?.type==='required' && <div><small><span className="text-danger">El campo "Marca" es obligatorio</span></small></div>}
                {errors.marca?.type==='maxLength' && <div><small><span className="text-danger">El campo "Marca" debe tener como máximo 30 caracteres</span></small></div>}

                <FormGroup label="Costo" type="text" register={{...register('costo', {required:true})}} />
                {errors.costo?.type==='required' && <div><small><span className="text-danger">El campo "Costo" es obligatorio</span></small></div>}

                {selectedCategorie === "Laptop" && (
                    <>
                        <FormGroup label="Procesador" type="select" options={processorOptions} register={{...register('procesador', {required:true})}} helpText="* Seleccione una opción"/>

                        <FormGroup label="Memoria RAM" register={{...register('memoria_ram', {required:true, maxLength:10})}} />
                        {errors.memoria_ram?.type==='required' && <div><small><span className="text-danger">El campo "Memoria RAM" es obligatorio</span></small></div>}
                        {errors.memoria_ram?.type==='maxLength' && <div><small><span className="text-danger">El campo "Memoria RAM" debe tener como máximo 10 caracteres</span></small></div>}
                    </>
                )}

                {selectedCategorie === "Televisor" && (
                    <>
                        <FormGroup label="Tipo Pantalla" type="select" options={displayOptions} register={{...register('tipo_pantalla', {required:true})}} helpText="* Seleccione una opción"/>

                        <FormGroup label="Tamaño Pantalla" register={{...register('tamanio_pantalla', {required:true, maxLength:20})}} />
                        {errors.tamanio_pantalla?.type==='required' && <div><small><span className="text-danger">El campo "Tamaño Pantalla" es obligatorio</span></small></div>}
                        {errors.tamanio_pantalla?.type==='maxLength' && <div><small><span className="text-danger">El campo "Tamaño Pantalla" debe tener como máximo 20 caracteres</span></small></div>}
                    </>
                )}

                {selectedCategorie === "Zapatos" && (
                    <>
                        <FormGroup label="Material" type="select" options={materialOptions} register={{...register('material', {required:true})}} helpText="* Seleccione una opción"/>

                        <FormGroup label="Talle" register={{...register('talle', {required:true, maxLength:5})}} />
                        {errors.talle?.type==='required' && <div><small><span className="text-danger">El campo "Talle" es obligatorio</span></small></div>}
                        {errors.talle?.type==='maxLength' && <div><small><span className="text-danger">El campo "Talle" debe tener como máximo 5 caracteres</span></small></div>}
                    </>
                )} 

                <ButtonLoader loader={loader} type="submit" variant="primary">Guardar</ButtonLoader>

            </form>
        </div>
    )
}

export default ProductCreate
