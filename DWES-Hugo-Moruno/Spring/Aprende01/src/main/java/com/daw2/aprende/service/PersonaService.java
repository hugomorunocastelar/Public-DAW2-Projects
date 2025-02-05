package com.daw2.aprende.service;

import com.daw2.aprende.models.entity.Persona;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public interface PersonaService {

    List<Persona> findAll();
    Persona findByNif(String nif);
    Persona findByNombreAndApellido1AndApellido2(String nombre, String apellido1, String apellido2);
    Persona save(Persona persona);
    void delete(Persona persona);

}
