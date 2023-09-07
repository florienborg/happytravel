import React, { useState, useEffect } from "react";
import { useAuth } from "../contexts/AuthContext";
import "../css/Profile.css";
<<<<<<< Updated upstream
import axios from "axios";
import ViewOptions from "./ViewOptions";

import avatarIcon from "../assets/avatar-icon.svg";
import createIcon from "../assets/create-icon.svg";
import CardsGuest from "../components/CardsGuest";

export default function Profile() {
  const { user } = useAuth();
  const [avatar, setAvatar] = useState(avatarIcon);
  const [viewOption, setViewOption] = useState("favorites");
=======
import axios from 'axios'; 
import avatarIcon from '../assets/avatar-icon.svg';
import createIcon from '../assets/create-icon.svg';
import {  useNavigate } from 'react-router-dom';

export default function Profile() {
  const { user, hasRole } = useAuth();
  const [avatar, setAvatar] = useState(localStorage.getItem('avatar') || avatarIcon);
  const navigate = useNavigate();
>>>>>>> Stashed changes

  useEffect(() => {
    if (user.image) {
      // setAvatar(`http://localhost:8000/uploads/${user.image}`);
      setAvatar(`http://localhost:8000/storage/avatars/${user.image}`);
    }
  }, [user.image]);

  const handleImageChange = (event) => {
    const newAvatar = event.target.files[0];
    console.log("Nueva imagen seleccionada:", newAvatar);
    setAvatar(URL.createObjectURL(newAvatar));

    const formData = new FormData();
    formData.append("image", newAvatar);

    axios
      .post("http://localhost:8000/api/update-avatar", formData, {
        withCredentials: true,
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })
      .then(() => {
        console.log("Avatar subido con éxito");
      })
      .catch((error) => {
        console.error("Error al subir el avatar:", error);
      });
  };

  const changeView = (option) => {
    setViewOption(option);
  };

  return (
    <div className="container-profile">
      <img className="icon-nav profile" src={avatar} alt="icono perfil" />
      <label className="fileInput-create-avatar" htmlFor="fileInput">
        <img
          className="icon-nav profileAvatar"
          src={createIcon}
          alt="icono de agregar fotografía"
        />
        <input
          id="fileInput"
          type="file"
          accept="image/*"
          onChange={handleImageChange}
        />
      </label>
      <h2 className="info-perfil title-profile">{user.name}</h2>
      <div className="info-perfil">
        Email: <span>{user.email}</span>
      </div>
<<<<<<< Updated upstream
      <ViewOptions viewOption={viewOption} onViewOptionChange={changeView} />
      <div className="container-card-profile">
        <CardsGuest user_id={user.id} />
      </div>
    </div>
=======
	  {hasRole('SuperAdmin') && (
                    <>      <button type="button" className="btn btn-primary" onClick={() => navigate('/admin')}>Usuarios</button>            </> 
                    
                    )}
	  </div>
>>>>>>> Stashed changes
  );
}

{
  /* <img className="icon-nav profile" src={`http://localhost:8000/storage/avatars/1694076757_covers.jpg`} alt="icono perfil" />
<img className="icon-nav profile" src={`http://localhost:8000/storage/avatars/${user.image}`} alt="icono perfil" /> */
}
