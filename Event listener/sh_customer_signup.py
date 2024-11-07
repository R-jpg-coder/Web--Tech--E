# -*- coding: utf-8 -*-
# Part of Softhealer Technologies.

from odoo import http
from odoo.http import request
import base64

class CreateCustomer(http.Controller):

    @http.route(['/customer-sign-up'], type='http', auth="public", website=True)
    def create_customer(self, **post):
        """
            Custom Controller for country info.
        """
        quote_msg = {}
        emails = []
        image = 0
        multi_users_value = [0]
        contacts = []

        if post:
            customer_name = post.get('customer_name', False)
            customer_email = post.get('customer_email', False)
            customer_phone = post.get('customer_phone', False)
            customer_mobile = post.get('customer_mobile', False)
            customer_street = post.get('customer_street', False)
            customer_street2 = post.get('customer_street2', False)
            customer_website = post.get('customer_website', False)
            customer_zip_code = post.get('customer_zip_code', False)
            customer_city = post.get('customer_city', False)
            customer_country = post.get('country_id', False)
            customer_state = post.get('state_id', False)

            # Country
            customer_country = post.get('country_id', False)
            if customer_country in ['', "", False, 0]:
                customer_country = False
            else:
                customer_country = int(customer_country)

            # States
            customer_state = post.get('state_id', False)
            if customer_state in ['', "", False, 0]:
                customer_state = False
            else:
                customer_state = int(customer_state)

            customer_type = post.get('customer_type', False)
            customer_comment = post.get('customer_comment', False)
            customer_note = post.get('customer_note', False)
            if post.get('customer_image', False):
                img = post.get('customer_image')
                image = base64.b64encode(img.read())
            multi_users_value = request.httprequest.form.getlist(
                'category_section')
            for l in range(0, len(multi_users_value)):
                multi_users_value[l] = int(multi_users_value[l])
            country = 'country_id' in post and post['country_id'] != '' and request.env['res.country'].browse(
                int(post['country_id']))
            country = country and country.exists()
            customer_dic = {
                'name': customer_name,
                'street': customer_street,
                'street2': customer_street2,
                'phone': customer_phone,
                'mobile': customer_mobile,
                'email': customer_email,
                'website': customer_website,
                'zip': customer_zip_code,
                'city': customer_city,
                'country_id': int(customer_country) if int(customer_country) else False,
                'state_id': int(customer_state) if int(customer_state) else False,
                'company_type': customer_type,
                'customer_products': customer_comment,
                'comment': customer_note,
                'image_1920': image,
                'customer_product_categ_ids': [(6, 0, multi_users_value)] or [],
                'customer_rank': 1,
                'supplier_rank': 0,
            }
            customer_id = request.env['res.partner'].sudo().create(
                customer_dic)

            if customer_id:
                template_id = request.env.ref('sh_customer_signup.email_template_of_welcome')
                template_id.sudo().with_context().send_mail(customer_id.id,force_send=True)
                template_id_1 = request.env.ref('sh_customer_signup.email_to_admin_for_new_customer')
                template_id_1.sudo().with_context().send_mail(customer_id.id,force_send=True)
                quote_msg = {
                    'success': 'Customer ' + customer_name + ' created successfully.'
                }
                if request.website.is_enable_customer_notification and request.website.sudo().user_ids.sudo():
                    for user in request.website.user_ids.sudo():
                        if user.sudo().partner_id.sudo() and user.sudo().partner_id.sudo().email:
                            emails.append(user.sudo().partner_id.sudo().email)
                email_values = {
                    'email_to': 'admin@designedtotalk.com'.join(emails),
                    'email_from': request.website.company_id.sudo().email,
                }
                url = ''
                base_url = request.env['ir.config_parameter'].sudo(
                ).get_param('web.base.url')
                url = base_url + "/web#id=" + \
                    str(customer_id.id) + \
                    "&&model=res.partner&view_type=form"
                ctx = {
                    "customer_url": url,
                }
                # template_id = request.env['ir.model.data']._xmlid_to_res_id(
                #     'sh_customer_signup.sh_customer_signup_email_notification')
                # _ = request.env['mail.template'].sudo().browse(template_id).with_context(ctx).send_mail(
                #     customer_id.id, email_values=email_values, email_layout_xmlid='mail.mail_notification_light', force_send=True)

            contact_dic = {k: v for k, v in post.items(
            ) if k.startswith('customer_c_name_')}
            if customer_id and contact_dic:
                for key, value in contact_dic.items():
                    customer_dic = {}
                    if "customer_c_name_" in key:
                        customer_dic["name"] = value

                        numbered_key = key.replace(
                            "customer_c_name_", "") or ''
                        email_key = 'customer_c_email_' + numbered_key
                        phone_key = 'customer_c_phone_' + numbered_key

                        if post.get(email_key, False):
                            customer_dic["email"] = post.get(email_key)
                        if post.get(phone_key, False):
                            customer_dic["phone"] = post.get(phone_key)

                        customer_dic["type"] = 'contact'
                        customer_dic["parent_id"] = customer_id.id

                        # fill list:
                        contact_id = request.env["res.partner"].sudo().create(
                            customer_dic)
                        if contact_id:
                            contacts.append(contact_id.id)

            try:
                if request.website.is_enable_auto_portal_user:
                    if request.website.is_enable_company_portal_user:
                        user_id = request.env['res.users'].sudo().search(
                            [('partner_id', '=', customer_id.id)], limit=1)
                        if not user_id and customer_id:
                            portal_wizard_obj = request.env['portal.wizard']
                            created_portal_wizard = portal_wizard_obj.sudo().create({})
                            if created_portal_wizard and customer_id.email and request.env.user:
                                portal_wizard_user_obj = request.env['portal.wizard.user']
                                wiz_user_vals = {
                                    'wizard_id': created_portal_wizard.id,
                                    'partner_id': customer_id.id,
                                    'email': customer_id.email,
                                    'is_portal': True,
                                    'user_id': request.env.user.id or False,
                                }
                                created_portal_wizard_user = portal_wizard_user_obj.sudo().create(wiz_user_vals)
                                if created_portal_wizard_user:
                                    created_portal_wizard_user.sudo().action_grant_access()

                    if request.website.is_enable_company_contact_portal_user:
                        if len(contacts) > 0:
                            for contact in contacts:
                                user_id = request.env['res.users'].sudo().search(
                                    [('partner_id', '=', contact)], limit=1)
                                partner = request.env['res.partner'].sudo().browse(
                                    contact)
                                if not user_id and partner:
                                    portal_wizard_obj = request.env['portal.wizard']
                                    created_portal_wizard = portal_wizard_obj.sudo().create({})
                                    if created_portal_wizard and customer_id.email and request.env.user:
                                        portal_wizard_user_obj = request.env['portal.wizard.user']
                                        wiz_user_vals = {
                                            'wizard_id': created_portal_wizard.id,
                                            'partner_id': partner.id,
                                            'email': partner.email,
                                            'is_portal': True,
                                            'user_id': request.env.user.id or False,
                                        }
                                        created_portal_wizard_user = portal_wizard_user_obj.sudo().create(wiz_user_vals)
                                        if created_portal_wizard_user:
                                            created_portal_wizard_user.sudo().action_grant_access()
            except Exception as e:
                quote_msg = {
                    'fail': str(e)
                }

        countries = request.env["res.country"].sudo().search([])
        country_states = request.env["res.country"].state_ids

        values = {
            'page_name': 'customer_sign_up_form_page',
            'default_url': '/customer-sign-up',
            'quote_msg': quote_msg,
            'country_states': country_states,
            'countries': countries,
        }
        return request.render("sh_customer_signup.customer_sign_up_form_view", values)

    @http.route(['/customer-sign-up/<model("res.country"):country>'], type='json', auth="public", methods=['POST'], website=True)
    def sh_country_infos(self, country, **kw):
        """
            Custom Controller for country info.
        """
        return dict(
            states=[(st.id, st.name, st.code) for st in country.state_ids],
            phone_code=country.phone_code,
            zip_required=country.zip_required,
            state_required=country.state_required,
        )
