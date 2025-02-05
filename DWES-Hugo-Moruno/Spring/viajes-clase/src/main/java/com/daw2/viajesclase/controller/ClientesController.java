package com.daw2.viajesclase.controller;

import com.daw2.viajesclase.models.dto.ClienteDTO;
import com.daw2.viajesclase.models.entity.Cliente;
import com.daw2.viajesclase.service.impl.ClienteServiceImpl;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@CrossOrigin("*")
@Slf4j
@RestController
@RequestMapping("/clientes")
public class ClientesController {

    @Autowired
    ClienteServiceImpl clienteService;

    @GetMapping("")
    public ResponseEntity<?> getClientes()
    {
        try {
            return ResponseEntity.status(HttpStatus.OK).body(ClienteDTO.from(clienteService.findAll()));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(e.getMessage());
        }
    }

    @PostMapping("")
    public ResponseEntity<?> saveCliente(@RequestBody Cliente cliente)
    {
        try {
            return ResponseEntity.status(HttpStatus.OK).body(ClienteDTO.from(clienteService.save(cliente)));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }

    @GetMapping("/{id}")
    public ResponseEntity<?> getClienteId(@PathVariable Long id)
    {
        try {
            return ResponseEntity.status(HttpStatus.OK).body(ClienteDTO.from(clienteService.findById(id)));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(e.getMessage());
        }
    }

    @PutMapping("/{id}")
    public ResponseEntity<?> updateCliente(@RequestBody Cliente cliente, @PathVariable Long id)
    {
        cliente.setId(id);
        try {
            return ResponseEntity.status(HttpStatus.OK).body(ClienteDTO.from(clienteService.save(cliente)));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }

    @GetMapping("")
    public ResponseEntity<?> deleteCliente(@RequestBody Cliente cliente)
    {
        try {
            clienteService.delete(cliente);
            return ResponseEntity.status(HttpStatus.OK).body(ClienteDTO.from(cliente));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(e.getMessage());
        }
    }


}
