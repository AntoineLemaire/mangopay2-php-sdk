<?php
namespace MangoPay\Tests;
require_once 'base.php';

/**
 * Tests basic methods for mandates
 */
class Mandates extends Base {
    
    function test_Mandates_Create() {
        $john = $this->getJohn();
        
        $mandate = $this->getJohnsMandate();
        
        $this->assertTrue($mandate->Id > 0);
        $this->assertEqual($mandate->UserId, $john->Id);
    }
    
    function test_Mandates_Get() {
        $john = $this->getJohn();
        $mandate = $this->getJohnsMandate();
        
        $getMandate = $this->_api->Mandates->Get($mandate->Id);
        
        $this->assertIdentical($mandate->Id, $getMandate->Id);
        $this->assertEqual($getMandate->UserId, $john->Id);
    }
    
    function test_Mandates_Cancel() {
        $mandate = $this->getJohnsMandate();
        
        $cancelMandate = $this->_api->Mandates->Cancel($mandate->Id);
        
        $this->assertIdentical($mandate->Id, $cancelMandate->Id);
        $this->assertIdentical('FAILED', $cancelMandate->Status);
    }
    
    function test_Mandates_GetAll() {
        $this->getJohnsMandate();
        
        $mandates = $this->_api->Mandates->GetAll(new \MangoPay\Pagination());
        
        $this->assertTrue(count($mandates) > 0);
    }
}