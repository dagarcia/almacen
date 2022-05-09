import Form from 'react-bootstrap/Form'

function FormGroup(props) {
    const {label, type, register, placeholder, helpText, options, onChange} = props
    let formControl;
    if (type === "select") {
        formControl = <Form.Select {...register} onChange={onChange}>{options.map(option=><option value={option} key={option}>{option}</option>)}</Form.Select>
    } else {
        formControl = <Form.Control type={type || "text"} {...register} placeholder={placeholder || ""} />
    }

    return (
        <Form.Group className="mb-3" controlId={label}>
            <Form.Label>{label}</Form.Label>
                {formControl}         
            <Form.Text className="text-muted">
                <i>{helpText || ""}</i>
            </Form.Text>
        </Form.Group>
    )
}

export default FormGroup
