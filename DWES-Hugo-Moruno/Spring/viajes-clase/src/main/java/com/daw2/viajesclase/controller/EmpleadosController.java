package com.daw2.viajesclase.controller;

import com.daw2.viajesclase.models.dto.EmpleadoDTO;
import com.daw2.viajesclase.models.entity.Empleado;
import com.daw2.viajesclase.service.impl.EmpleadoServiceImpl;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@CrossOrigin("*")
@Slf4j
@RestController
@RequestMapping("/empleados")
public class EmpleadosController {

    @Autowired
    EmpleadoServiceImpl empleadoService;

    @GetMapping("")
    public ResponseEntity<?> getEmpleados()
    {
        try {
            return ResponseEntity.status(HttpStatus.OK).body(EmpleadoDTO.from(empleadoService.findAll()));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(e.getMessage());
        }
    }

    @PostMapping("")
    public ResponseEntity<?> saveEmpleado(@RequestBody Empleado empleado)
    {
        try {
            return ResponseEntity.status(HttpStatus.OK).body(EmpleadoDTO.from(empleadoService.save(empleado)));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }

    @GetMapping("/{id}")
    public ResponseEntity<?> getEmpleadoId(@PathVariable Long id)
    {
        try {
            return ResponseEntity.status(HttpStatus.OK).body(EmpleadoDTO.from(empleadoService.findById(id)));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(e.getMessage());
        }
    }

    @PutMapping("/{id}")
    public ResponseEntity<?> updateEmpleado(@RequestBody Empleado empleado, @PathVariable Long id)
    {
        empleado.setId(id);
        try {
            return ResponseEntity.status(HttpStatus.OK).body(EmpleadoDTO.from(empleadoService.save(empleado)));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }

    @GetMapping("")
    public ResponseEntity<?> deleteEmpleado(@RequestBody Empleado empleado)
    {
        try {
            empleadoService.delete(empleado);
            return ResponseEntity.status(HttpStatus.OK).body(EmpleadoDTO.from(empleado));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }


}
