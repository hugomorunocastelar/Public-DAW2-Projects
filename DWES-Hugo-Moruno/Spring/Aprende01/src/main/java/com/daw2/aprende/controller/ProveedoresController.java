package com.daw2.aprende.controller;

import com.daw2.aprende.models.dto.ProveedorArticulosDTO;
import com.daw2.aprende.models.dto.ProveedorDTO;
import com.daw2.aprende.models.entity.Persona;
import com.daw2.aprende.models.entity.Proveedor;
import com.daw2.aprende.service.impl.ProveedorServiceImpl;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@CrossOrigin("*")
@Slf4j
@RestController
@RequestMapping("/proveedores")
public class ProveedoresController {

    @Autowired
    ProveedorServiceImpl proveedorService;

    @GetMapping("/all")
    public ResponseEntity<?> getProveedores()
    {
        try
        {
            return ResponseEntity.status(HttpStatus.OK).body(ProveedorDTO.from(proveedorService.findAll()));
        }
        catch (Exception e)
        {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(e.getMessage());
        }
    }

    @GetMapping("/{nif}")
    public ResponseEntity<?> getProveedor(@PathVariable String nif)
    {
        try
        {
            return ResponseEntity.status(HttpStatus.OK).body(ProveedorDTO.from(proveedorService.findByNif(nif)));
        }
        catch (Exception e)
        {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(e.getMessage());
        }
    }

    @GetMapping("/{nif}/articulos")
    public ResponseEntity<?> getProveedorWithArticulos(@PathVariable String nif)
    {
        try
        {
            ProveedorArticulosDTO proveedorArticulosDTO = ProveedorArticulosDTO.from(proveedorService.findByNif(nif));

            return ResponseEntity.status(HttpStatus.OK).body(proveedorArticulosDTO);
        }
        catch (Exception e)
        {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(e.getMessage());
        }
    }

    @PostMapping("/save")
    public ResponseEntity<?> saveProveedor(@RequestBody Proveedor proveedor)
    {
        try
        {
            proveedorService.save(proveedor);
            return ResponseEntity.status(HttpStatus.OK).body(ProveedorDTO.from(proveedor));
        }
        catch (Exception e)
        {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }

    @PostMapping("/delete")
    public ResponseEntity<?> deleteProveedor(@RequestBody Proveedor proveedor)
    {
        try
        {
            proveedorService.delete(proveedor);
            return ResponseEntity.status(HttpStatus.OK).body(ProveedorDTO.from(proveedor));
        }
        catch (Exception e)
        {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }

}
