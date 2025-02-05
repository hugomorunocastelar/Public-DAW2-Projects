package com.daw2.aprende.models.repository;

import com.daw2.aprende.models.entity.Persona;
import com.daw2.aprende.models.entity.Proveedor;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ProveedorRepository extends JpaRepository<Proveedor, Long> {

    Proveedor findByNif(String nif);

}
