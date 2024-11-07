# -*- coding: utf-8 -*-
# Part of Softhealer Technologies.

from odoo import models, fields, _



class ResPartner(models.Model):
    _inherit = "res.partner"

    customer_products = fields.Text('Products')
    customer_product_categ_ids = fields.Many2many(comodel_name='product.category', relation='cust_categ_sh_customer_signup_rel',string='Product Categories')
    