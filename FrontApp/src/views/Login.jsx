import '../assets/styles/login.css';
import overlay_img from '../assets/images/login-back.jpg';
import santander_logo from '../assets/images/logo_name.svg';
import logo_red from '../assets/images/logoRed.png';

export default function Login() {
    return (
        <>
            <div className="overlay" style={{ backgroundImage: `url('${overlay_img}')` }}>
                <img src={santander_logo} alt="" className='whitelogo' />
                <form action="#"> {/* Añadir event listener para el submit */}
                    <img src={logo_red} alt="Logo in color red" />
                    <h2>Sign in</h2>
                </form>
            </div>
        </>
    )
}