import {Button, Spinner} from 'react-bootstrap'

function ButtonLoader(props) {
    const {variant, type, loader, onClick} = props

    return(
        <Button
            type={type || "submit"}
            variant={variant || "primary"}
            disabled={loader}
            onClick={onClick}
        >
            {
                loader &&
                <Spinner animation="border" size="sm" />
            }
        {props.children}
        </Button>
    )
}

export default ButtonLoader
