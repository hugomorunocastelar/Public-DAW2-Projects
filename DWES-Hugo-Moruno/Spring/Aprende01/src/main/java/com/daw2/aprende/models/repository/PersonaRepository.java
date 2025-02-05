package com.daw2.aprende.models.repository;

import com.daw2.aprende.models.entity.Persona;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface PersonaRepository extends JpaRepository<Persona, Integer> {

    Persona findByNif(String nif);
    Persona findByNombreAndApellido1AndApellido2(String nombre, String apellido1, String apellido2);

}
