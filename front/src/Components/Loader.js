import Spinner from 'react-bootstrap/Spinner'

function Loader(props) {
    const {loader, children, configuration} = props
    const style = {
        spinner: {
            marginLeft: "50%",
            marginRight: "50%",
            marginTop: "10%"
        }
    }

    if (loader) {
        return(
            <Spinner style={style.spinner} animation={configuration?.animation || "border"} role="status" variant={configuration?.variant || "dark"}>
                <span className="visually-hidden">Loading...</span>
            </Spinner>
        )
    } else {
        return(
            <>
                {children}
            </>
        )
    }
}

export default Loader
