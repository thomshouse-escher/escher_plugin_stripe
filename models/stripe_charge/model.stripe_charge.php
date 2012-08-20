<?php Load::Model('stripe');

    class Plugin_stripe_Model_stripe_charge extends Plugin_stripe_Model_stripe {
        protected $stripe_class='Stripe_Charge';

        protected $_schemaFields = array(
            'stripe_charge_id' => array('type' => 'string', 'length' => 64),
            'stripe_customer_id' => array('type' => 'string', 'length' => 64),
            'stripe_card_id' => array('type' => 'string', 'length' => 32),
            'stripe_charge_amount' => 'currency',
            'stripe_charge_currency' => array('type' => 'string', 'length' => '3'),
            'stripe_charge_created_at' => 'datetime',
            'stripe_charge_created_from' => 'resource',
            'stripe_charge_created_by' => 'id',
            'stripe_charge_modified_at' => 'datetime',
            'stripe_charge_modified_from' => 'resource',
            'stripe_charge_modified_by' => 'id',
            'stripe_charge_disputed' => array('type' => 'int', 'range' => 1),
            'stripe_charge_refunded' => array('type' => 'int', 'range' => 1),
            // Content
            'stripe_charge_description' => 'content',
        );

        function refund() {
            if (empty($this->stripe_charge_id)) { return false; }
            $this->call('refund');
            $this->stripe_charge_refunded = 1;
            $this->save();
        }
    }