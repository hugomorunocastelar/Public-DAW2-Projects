package com.daw2.aprende.models.repository;

import com.daw2.aprende.models.entity.Articulo;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ArticuloRepository extends JpaRepository<Articulo, Long> {

    Articulo findByReferencia(String referencia);

}
