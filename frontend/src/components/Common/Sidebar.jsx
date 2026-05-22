import React, { useState } from 'react';
import { Nav, Offcanvas } from 'react-bootstrap';
import { FaBars } from 'react-icons/fa';

export const Sidebar = () => {
  const [show, setShow] = useState(false);

  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);

  return (
    <>
      <button 
        className="btn btn-primary ms-2" 
        onClick={handleShow}
        style={{ position: 'fixed', top: '70px', left: '10px', zIndex: 1000 }}
      >
        <FaBars /> Menu
      </button>

      <Offcanvas show={show} onHide={handleClose} placement="start">
        <Offcanvas.Header closeButton>
          <Offcanvas.Title>Menu</Offcanvas.Title>
        </Offcanvas.Header>
        <Offcanvas.Body>
          <Nav className="flex-column gap-2">
            <Nav.Link href="/dashboard" onClick={handleClose} className="text-dark">
              Dashboard
            </Nav.Link>
            <Nav.Link href="/formations" onClick={handleClose} className="text-dark">
              Formations
            </Nav.Link>
            <Nav.Link href="/inscriptions" onClick={handleClose} className="text-dark">
              Inscriptions
            </Nav.Link>
            <Nav.Link href="/paiements" onClick={handleClose} className="text-dark">
              Paiements
            </Nav.Link>
            <Nav.Link href="/suivi" onClick={handleClose} className="text-dark">
              Suivi
            </Nav.Link>
          </Nav>
        </Offcanvas.Body>
      </Offcanvas>
    </>
  );
};

export default Sidebar;
