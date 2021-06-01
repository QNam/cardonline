<template>
    <div class="cardIndex">
        <div class="row">
            <div class="col-2">
                <el-input v-model="filter.cardId"  placeholder="Mã thẻ"></el-input>
            </div>
            <div class="col">
                <div class="text-end">
                    <el-button type="success" @click="exportExcel"><i class="fa fa-plus me-2" aria-hidden="true"></i>Xuất Excel</el-button>
                    <el-button type="primary" @click="toggleGenCard = true"><i class="fa fa-plus me-2" aria-hidden="true"></i>Tự động tạo thẻ</el-button>
                    <el-button type="primary" @click="openFormCard(null)"><i class="fa fa-plus me-2" aria-hidden="true"></i>Thêm thẻ</el-button>
                </div>  
            </div>
        </div>

        <div class="mt-5">
            <table class="el-table el-table--fit el-table--enable-row-hover el-table--enable-row-transition">
                <thead>
                    <th>Mã thẻ</th>
                    <th>Chủ thẻ</th>
                    <th>Số điện thoại</th>
                    <th>Mã xác thực</th>
                    <th>Ngày kích hoạt</th>
                    <th></th>
                </thead>
                <tbody v-if="listCard.length > 0" v-loading="loadGetCard">
                    <template v-for="(card, index) in listCard">    
                        <tr :key="index">
                            <td>
                                <el-popover
                                placement="right"
                                trigger="click">
                                <div>
                                    <p class="text-center m-0">{{ card.id }}</p>
                                    <img :src="card.qrCode" alt="">
                                </div>
                                    <span slot="reference" class="cursor-pointer"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                                </el-popover>
                                
                                <span class="ms-1">{{ card.id }}</span>
                            </td>
                            <td>{{ card.userName }}</td>
                            <td>{{ card.phoneNumber }}</td>
                            <td>{{ card.confirm_code }}</td>
                            <td></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <el-button size="mini" icon="el-icon-s-promotion"></el-button>
                                    <el-button @click="openFormCard(card)" class="me-2" size="mini" icon="el-icon-edit" type="warning"></el-button>
                                    <el-popconfirm
                                        confirm-button-text='OK'
                                        cancel-button-text='No, Thanks'   
                                        title="Bạn chắc chắn xóa ?" 
                                        @confirm="removeCard(card.id)">
                                        <el-button slot="reference" size="mini" icon="el-icon-delete" type="danger"></el-button>
                                    </el-popconfirm>
                                    
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
                <tbody v-else> 
                    <tr>
                        <td colspan="6" class="text-center">Hiện chưa có thẻ nào hoạt động</td>
                    </tr>
                </tbody>
            </table>
            <pagination 
                v-if="listCard.length > 0"
                class="mt-4 justify-content-center"
                :pageCount="filter.totalPage"
                :prevText="'Prev'"
                :nextText="'Next'"
                :value="filter.page"
                :click-handler="paginateCard"
            /> 
        </div>

        <el-dialog v-loading="loadSaveCard" :visible.sync="toogleFormCard">
            <div slot="title">
                <h5>{{cardSelected && cardSelected.id ? 'Cập nhật thẻ' : 'Thêm thẻ mới'}}</h5>
            </div>
            <div>
                <el-form :model="cardSelected" ref="formSaveCard" label-width="120px">
                    <el-form-item label="Mã thẻ" prop="id" required>
                        <el-input v-model="cardSelected.id"></el-input>
                    </el-form-item>
                    <div class="row">
                        <div class="col-12">
                            <el-form-item label="Họ tên"  prop="userName" required>
                                <el-input v-model="cardSelected.userName"></el-input>
                            </el-form-item>
                        </div>
                        <div class="col-12">
                            <el-form-item label="Email" prop="email">
                                <el-input v-model="cardSelected.email"></el-input>
                            </el-form-item>
                        </div>
                    </div>
                        
                    <el-form-item label="Số điện thoại" prop="phoneNumber">
                        <el-input v-model="cardSelected.phoneNumber"></el-input>
                    </el-form-item>
                </el-form>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="toogleFormCard = false">Hủy</el-button>
                <el-button type="primary" @click="saveCard">Lưu</el-button>
            </span>
        </el-dialog>

        <el-dialog :visible.sync="toggleGenCard">
            <div slot="title">
                <h5>Tự động tạo thẻ</h5>
            </div>
            <div class="d-flex">
                <el-input type="number" class="me-3" v-model="genCard.from" placeholder="Từ"></el-input>
                <el-input type="number" v-model="genCard.to" placeholder="Đến"></el-input>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="toggleGenCard = false">Hủy</el-button>
                <el-button type="primary" @click="doGenCard">Lưu</el-button>
            </span>
        </el-dialog>
        
        <div id="table-export" class="d-none">
            <table>
                <thead>
                    <th>STT</th>
                    <th>Mã thẻ</th>
                    <th>Mã xác thực</th>
                    <th>Link mã QR</th>
                </thead>
                <tbody>
                    <tr v-for="(card, index) in listCardExport" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ card.id }}</td>
                        <td>{{ card.confirm_code }}</td>
                        <td>
                            {{ card.qrCode }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
import * as cardApi from '../../../api/card'
import { exportExcel } from '../../../ultis'
import Pagination from '../Template/Paginate'

export default {
    components: {Pagination},
    data() {
        return {
            toogleFormCard: false,
            toggleGenCard: false,
            cardSelected: new cardApi.CardDTO(),
            filter: {
                page: 1,
                limit: 15,
                totalPage: 1,
            },
            genCard: {
                from: null,
                to: null
            },
            listCard: [],
            listCardExport: [],
            loadGetCard: false,
            loadSaveCard: false
        }
    },
    mounted() {
        this.getListCard()
    },
    methods: {
        async getListCard() {
            this.loadGetCard = true
            try {
                const params = {
                    page: this.filter.page,
                    limit: this.filter.limit
                }
                const response = await cardApi.getListCard(params);
                const data = response.data.data
                const pagination = response.data.pagination

                this.filter.totalPage = pagination.lastPage
                this.filter.page = pagination.currentPage

                this.listCard = data.map((val) => {
                    return new cardApi.CardDTO(val)
                })
            } catch (error) {
                console.error(error);
            }
            this.loadGetCard = false
        },

        async getAllCard() {
            const params = {
                page: 0,
                limit: 1000000,
                getForExport: true
            }
            const response = await cardApi.getListCard(params);
            const data = response.data.data

            this.listCardExport = data.map((val) => {
                return new cardApi.CardDTO(val)
            })
        },
        
        paginateCard(page) {
            this.filter.page = page
            this.getListCard()
        },

        openFormCard(card = null) {
            if(card) {
                this.cardSelected = _.cloneDeep(card)
            }

            this.toogleFormCard = true
        },

        async removeCard(cardId) {
            try {
                const rep = await  cardApi.removeCard(cardId)
                const status = rep.data.success
                this.getListCard()
                if(status) {
                    this.$notify.success({
                        title: 'Success',
                        message: 'Xóa thành công !'
                    });
                }

            } catch (error) {
                this.$notify.error({
                    title: 'Error',
                    message: 'Có lỗi xảy ra vui lòng thử lại sau !'
                });
            }
        },

        async doGenCard() {
            let params = {
                from: this.genCard.from,
                to: this.genCard.to
            }
            try {
                await cardApi.genCard(params);
                this.$notify.success({
                    title: 'Success',
                    message: 'Lưu thành công !'
                });
                this.toggleGenCard = false
                this.getListCard()
            } catch(e) {
                this.toggleGenCard = false
                this.$notify.error({
                    title: 'Error',
                    message: 'Có lỗi xảy ra! Vui lòng chắc chắn không có mã thẻ nào trong khoảng bị trùng mã'
                });
            }
        },

        async exportExcel() {
            this.$notify.info({
                title: 'info',
                message: 'Lấy dữ liệu export !'
            });

            await this.getAllCard()
            this.$notify.info({
                title: 'info',
                message: 'Lấy xong dữ liệu sẵn sàng export xin chờ trong 2s !'
            });
            setTimeout(function() {
                exportExcel('#table-export','DANH_SACH_THE' + (new Date()).getTime())
            }, 2000)
        },

        saveCard() {
            this.$refs.formSaveCard.validate( async (valid) => {
                if(valid) {
                    this.loadSaveCard = true
                    try {
                        const rep = await cardApi.storeCard(this.cardSelected)
                        const status = rep.data.success

                        this.loadSaveCard = false
                        this.toogleFormCard = false
                        this.getListCard()
                        
                        if(status) {
                            this.$notify.success({
                                title: 'Success',
                                message: 'Lưu thành công !'
                            });
                        }
                    } catch (error) {
                        this.loadSaveCard = false
                        this.$notify.error({
                            title: 'Error',
                            message: 'Có lỗi xảy ra vui lòng thử lại sau !'
                        });
                    }
                }
            })
        }
    }
}
</script>

<style>

</style>